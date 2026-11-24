<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** Central FREE/PRO usage control. PRO products can unlock features through the filter. */
final class Edroz_QR_Usage {
    const OPTION = 'edroz_qr_usage_v1';
    const LIMITS = array(
        'discount' => 50,
        'timer' => 50,
        'whatsapp' => 50,
        'bulk' => 20,
        'stats_days' => 30,
    );

    public static function init() {
        add_action( 'admin_post_edroz_yape_whatsapp', array( __CLASS__, 'track_whatsapp' ) );
    }

    public static function is_pro() {
        return (bool) apply_filters( 'edroz_qr_payments_is_pro', false );
    }

    private static function data() {
        $data = get_option( self::OPTION, array() );
        if ( ! is_array( $data ) ) { $data = array(); }
        $data = wp_parse_args( $data, array( 'counts' => array(), 'keys' => array(), 'stats_started' => 0 ) );
        if ( ! is_array( $data['counts'] ) ) { $data['counts'] = array(); }
        if ( ! is_array( $data['keys'] ) ) { $data['keys'] = array(); }
        return $data;
    }

    public static function can_use( $feature ) {
        if ( self::is_pro() ) { return true; }
        if ( ! isset( self::LIMITS[ $feature ] ) || 'stats_days' === $feature ) { return false; }
        $data = self::data();
        return absint( $data['counts'][ $feature ] ?? 0 ) < self::LIMITS[ $feature ];
    }

    public static function consume( $feature, $units = 1, $unique_key = '' ) {
        if ( self::is_pro() ) { return true; }
        if ( ! isset( self::LIMITS[ $feature ] ) || 'stats_days' === $feature ) { return false; }
        $units = max( 1, absint( $units ) );
        $lock = 'edroz_qr_usage_lock';
        if ( get_transient( $lock ) ) { return false; }
        set_transient( $lock, 1, 5 );
        $data = self::data();
        $used = absint( $data['counts'][ $feature ] ?? 0 );
        if ( $unique_key && in_array( (string) $unique_key, (array) ( $data['keys'][ $feature ] ?? array() ), true ) ) {
            delete_transient( $lock );
            return true;
        }
        if ( $used + $units > self::LIMITS[ $feature ] ) {
            delete_transient( $lock );
            return false;
        }
        $data['counts'][ $feature ] = $used + $units;
        if ( $unique_key ) {
            if ( empty( $data['keys'][ $feature ] ) || ! is_array( $data['keys'][ $feature ] ) ) { $data['keys'][ $feature ] = array(); }
            $data['keys'][ $feature ][] = (string) $unique_key;
            $data['keys'][ $feature ] = array_slice( $data['keys'][ $feature ], -1000 );
        }
        update_option( self::OPTION, $data, false );
        delete_transient( $lock );
        return true;
    }

    public static function remaining( $feature ) {
        if ( self::is_pro() ) { return PHP_INT_MAX; }
        if ( ! isset( self::LIMITS[ $feature ] ) ) { return 0; }
        $data = self::data();
        return max( 0, self::LIMITS[ $feature ] - absint( $data['counts'][ $feature ] ?? 0 ) );
    }

    public static function used( $feature ) {
        $data = self::data();
        return absint( $data['counts'][ $feature ] ?? 0 );
    }

    public static function stats_available() {
        if ( self::is_pro() ) { return true; }
        $data = self::data();
        if ( empty( $data['stats_started'] ) ) {
            $data['stats_started'] = time();
            update_option( self::OPTION, $data, false );
        }
        return ( time() - absint( $data['stats_started'] ) ) < ( self::LIMITS['stats_days'] * DAY_IN_SECONDS );
    }

    public static function stats_days_left() {
        $data = self::data();
        if ( empty( $data['stats_started'] ) ) { return self::LIMITS['stats_days']; }
        return max( 0, self::LIMITS['stats_days'] - (int) floor( ( time() - absint( $data['stats_started'] ) ) / DAY_IN_SECONDS ) );
    }

    public static function whatsapp_url( $order_id, $phone, $message ) {
        $url = add_query_arg( array(
            'action' => 'edroz_yape_whatsapp',
            'order_id' => absint( $order_id ),
            'phone' => rawurlencode( preg_replace( '/[^0-9]/', '', $phone ) ),
            'text' => rawurlencode( $message ),
        ), admin_url( 'admin-post.php' ) );
        return wp_nonce_url( $url, 'edroz_yape_whatsapp_' . absint( $order_id ) );
    }

    public static function track_whatsapp() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) { wp_die( esc_html__( 'No tienes permisos.', 'edroz-qr-payments' ), '', array( 'response' => 403 ) ); }
        $order_id = isset( $_GET['order_id'] ) ? absint( $_GET['order_id'] ) : 0;
        check_admin_referer( 'edroz_yape_whatsapp_' . $order_id );
        $order = wc_get_order( $order_id );
        if ( ! $order || 'yapepay' !== $order->get_payment_method() ) { wp_die( esc_html__( 'Pedido no válido.', 'edroz-qr-payments' ) ); }
        if ( ! self::consume( 'whatsapp', 1, 'order-' . $order_id ) ) {
            wp_die( esc_html__( 'Has agotado los 50 usos gratuitos de WhatsApp. Consulta Edroz QR Payments PRO para continuar. Tus cobros siguen funcionando normalmente.', 'edroz-qr-payments' ) );
        }
        $phone = isset( $_GET['phone'] ) ? preg_replace( '/[^0-9]/', '', sanitize_text_field( wp_unslash( $_GET['phone'] ) ) ) : '';
        $message = isset( $_GET['text'] ) ? sanitize_text_field( wp_unslash( $_GET['text'] ) ) : '';
        if ( ! $phone || ! $message ) { wp_die( esc_html__( 'Faltan datos de contacto.', 'edroz-qr-payments' ) ); }
        $whatsapp_url = 'https://wa.me/' . $phone . '?text=' . rawurlencode( $message );
        add_filter( 'allowed_redirect_hosts', static function( $hosts ) {
            $hosts[] = 'wa.me';
            return $hosts;
        } );
        wp_safe_redirect( $whatsapp_url );
        exit;
    }
}
Edroz_QR_Usage::init();
