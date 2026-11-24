<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Optional Yape checkout enhancements. All options are disabled by default.
 */
final class Edroz_Yape_Extras {
    public static function init() {
        add_action( 'woocommerce_cart_calculate_fees', array( __CLASS__, 'apply_yape_discount' ), 20 );
        add_action( 'woocommerce_thankyou_yapepay', array( __CLASS__, 'render_payment_timer' ), 20 );
        add_action( 'woocommerce_checkout_order_processed', array( __CLASS__, 'store_timer_deadline' ), 20, 3 );
        add_action( 'woocommerce_checkout_order_processed', array( __CLASS__, 'consume_discount_use' ), 21, 3 );
    }

    private static function settings() {
        $settings = get_option( 'woocommerce_yapepay_settings', array() );
        return is_array( $settings ) ? $settings : array();
    }

    public static function apply_yape_discount( $cart ) {
        if ( is_admin() && ! wp_doing_ajax() ) { return; }
        if ( ! function_exists( 'WC' ) || ! WC()->session || ! $cart || $cart->is_empty() ) { return; }
        $chosen = WC()->session->get( 'chosen_payment_method' );
        if ( 'yapepay' !== $chosen ) { return; }
        $settings = self::settings();
        $percent = isset( $settings['yape_discount_percent'] ) ? (float) $settings['yape_discount_percent'] : 0;
        $percent = min( 50, max( 0, $percent ) );
        if ( $percent <= 0 || ! class_exists( 'Edroz_QR_Usage' ) || ! Edroz_QR_Usage::can_use( 'discount' ) ) { return; }
        $base = (float) $cart->get_cart_contents_total();
        if ( $base <= 0 ) { return; }
        $discount = round( $base * ( $percent / 100 ), wc_get_price_decimals() );
        if ( $discount > 0 ) {
            if ( WC()->session ) { WC()->session->set( 'edroz_yape_discount_applied', 'yes' ); }
            // translators: %s is the configured Yape discount percentage.
            $cart->add_fee( sprintf( __( 'Descuento por pagar con Yape (%s%%)', 'edroz-qr-payments' ), wc_format_localized_decimal( $percent ) ), -$discount, true );
        }
    }

    public static function store_timer_deadline( $order_id, $posted_data, $order ) {
        if ( ! $order instanceof WC_Order || 'yapepay' !== $order->get_payment_method() ) { return; }
        $settings = self::settings();
        $minutes = isset( $settings['payment_timer_minutes'] ) ? absint( $settings['payment_timer_minutes'] ) : 0;
        if ( $minutes < 1 || $minutes > 180 || $order->get_meta( '_edroz_yape_payment_deadline', true ) ) { return; }
        if ( ! class_exists( 'Edroz_QR_Usage' ) || ! Edroz_QR_Usage::consume( 'timer', 1, 'order-' . $order_id ) ) { return; }
        $deadline = time() + ( $minutes * MINUTE_IN_SECONDS );
        $order->update_meta_data( '_edroz_yape_payment_deadline', $deadline );
        $order->update_meta_data( '_edroz_yape_payment_timer_minutes', $minutes );
        $order->save();
    }


    public static function consume_discount_use( $order_id, $posted_data, $order ) {
        if ( ! $order instanceof WC_Order || 'yapepay' !== $order->get_payment_method() ) { return; }
        if ( $order->get_meta( '_edroz_yape_discount_usage_counted', true ) ) { return; }
        foreach ( $order->get_items( 'fee' ) as $fee ) {
            if ( false !== stripos( $fee->get_name(), 'Descuento por pagar con Yape' ) ) {
                if ( class_exists( 'Edroz_QR_Usage' ) && Edroz_QR_Usage::consume( 'discount', 1, 'order-' . $order_id ) ) {
                    $order->update_meta_data( '_edroz_yape_discount_usage_counted', 1 );
                    $order->save();
                }
                break;
            }
        }
    }

    public static function render_payment_timer( $order_id ) {
        $order = wc_get_order( $order_id );
        if ( ! $order || 'yapepay' !== $order->get_payment_method() ) { return; }
        $deadline = absint( $order->get_meta( '_edroz_yape_payment_deadline', true ) );
        if ( ! $deadline || $order->is_paid() ) { return; }
        ?>
        <div class="edroz-yape-timer" data-deadline="<?php echo esc_attr( $deadline ); ?>" role="status">
            <strong><?php esc_html_e( 'Tiempo recomendado para completar tu pago:', 'edroz-qr-payments' ); ?></strong>
            <span class="edroz-yape-timer-value">--:--</span>
            <small><?php esc_html_e( 'Al finalizar el tiempo, el pedido no se cancela automáticamente. Si ya pagaste, espera la verificación de la tienda.', 'edroz-qr-payments' ); ?></small>
        </div>
        <script>
        (function(){var box=document.querySelector('.edroz-yape-timer');if(!box)return;var out=box.querySelector('.edroz-yape-timer-value');var end=parseInt(box.getAttribute('data-deadline'),10);function tick(){var left=Math.max(0,end-Math.floor(Date.now()/1000));var m=Math.floor(left/60),s=left%60;out.textContent=('0'+m).slice(-2)+':'+('0'+s).slice(-2);if(left<=0){box.classList.add('is-expired');clearInterval(timer);}}tick();var timer=setInterval(tick,1000);})();
        </script>
        <?php
    }
}
