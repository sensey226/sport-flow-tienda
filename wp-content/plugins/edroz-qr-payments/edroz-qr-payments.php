<?php
/**
 * Plugin Name: Edroz QR Payments
 * Plugin URI: https://edroz-design.com/plugins/
 * Description: Método de pago manual Yape para WooCommerce, con QR, datos dinámicos y registro opcional de operación.
 * Version: 7.2.7
 * Author: Edroz Design
 * Author URI: https://www.edroz-design.com
 * License: GPL-3.0+
 * Text Domain: edroz-qr-payments
 * Requires Plugins: woocommerce
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * WC tested up to: 10.9
 */

if (!defined('ABSPATH')) exit;

/**
 * Declare compatibility with WooCommerce features.
 * HPOS is supported because order data is accessed through WooCommerce CRUD APIs.
 * Checkout Blocks support is provided by the dedicated Blocks integration class.
 */
add_action('before_woocommerce_init', function() {
    if (!class_exists('Automattic\\WooCommerce\\Utilities\\FeaturesUtil')) {
        return;
    }

    Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
        'custom_order_tables',
        __FILE__,
        true
    );

    Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
        'cart_checkout_blocks',
        __FILE__,
        true
    );
});

final class Edroz_Yape_Plin_Payment {
    const VERSION = '7.2.7';

    public static function init() {
        add_action('plugins_loaded', array(__CLASS__, 'load_gateways'), 20);
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_frontend'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_admin'));
        add_action('woocommerce_checkout_process', array(__CLASS__, 'validate_operation_field'));
        add_action('woocommerce_admin_order_data_after_billing_address', array(__CLASS__, 'admin_order_operation'));
        add_action('woocommerce_order_details_after_order_table', array(__CLASS__, 'order_operation'));
    }

    public static function load_gateways() {
        if (!class_exists('WC_Payment_Gateway')) return;
        require_once __DIR__ . '/includes/class-edroz-yape-admin.php';
        require_once __DIR__ . '/includes/class-edroz-yape-reviews.php';
        require_once __DIR__ . '/includes/class-edroz-yape-extras.php';
        require_once __DIR__ . '/includes/class-edroz-usage.php';
        Edroz_Yape_Reviews::init();
        Edroz_Yape_Extras::init();
        add_action('admin_menu', array('Edroz_Yape_Reviews', 'register_menu'), 20);
        add_action('admin_enqueue_scripts', array('Edroz_Yape_Reviews', 'enqueue_assets'));
        require_once __DIR__ . '/includes/class-edroz-yape-plin-gateway.php';
        require_once __DIR__ . '/includes/class-edroz-yape-plin-blocks.php';
        add_filter('woocommerce_payment_gateways', function($methods) {
            $methods[] = 'Edroz_Yape_Gateway';
            return $methods;
        });
    }

    public static function enqueue_frontend() {
        if (!function_exists('is_checkout')) return;
        $is_relevant = is_checkout() || is_order_received_page() || (function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('order-pay'));
        if (!$is_relevant) return;
        wp_enqueue_style('edroz-yape-plin', plugins_url('assets/css/yape-plin.css', __FILE__), array(), self::VERSION);
        wp_enqueue_script('edroz-yape-plin', plugins_url('assets/js/yape-plin.js', __FILE__), array('jquery'), self::VERSION, true);
        wp_localize_script('edroz-yape-plin', 'EdrozYapePlin', array(
            'copied' => __('¡Copiado!', 'edroz-qr-payments'),
            'copyError' => __('No se pudo copiar. Puedes seleccionarlo manualmente.', 'edroz-qr-payments'),
        ));
    }

    public static function enqueue_admin($hook) {
        if ($hook !== 'woocommerce_page_wc-settings') return;
        wp_enqueue_media();
        wp_enqueue_script('edroz-yape-plin-admin', plugins_url('assets/js/admin.js', __FILE__), array('jquery'), self::VERSION, true);
    }


    public static function validate_operation_field() {
        // phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce validates the checkout request before this hook.
        $method = isset($_POST['payment_method']) ? sanitize_key(wp_unslash($_POST['payment_method'])) : '';
        if (!in_array($method, array('yapepay'), true)) return;
        $gateway = self::gateway_settings($method);
        if ($gateway && $gateway->get_option('operation_required', 'no') === 'yes') {
            // phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce validates the checkout request before this hook.
            $operation = isset($_POST['yape_plin_operation']) ? trim(sanitize_text_field(wp_unslash($_POST['yape_plin_operation']))) : '';
            if ($operation === '') wc_add_notice(__('Ingresa el número de operación de tu pago.', 'edroz-qr-payments'), 'error');
        }
    }

    private static function gateway_settings($id) {
        if (!function_exists('WC') || !WC()->payment_gateways()) return null;
        $gateways = WC()->payment_gateways()->payment_gateways();
        return isset($gateways[$id]) ? $gateways[$id] : null;
    }

    public static function save_operation($order_id) {
        // phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce validates the checkout request before process_payment/save_operation.
        if (!isset($_POST['yape_plin_operation'])) return;
        // phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce validates the checkout request before process_payment/save_operation.
        $operation = sanitize_text_field(wp_unslash($_POST['yape_plin_operation']));
        if ($operation !== '') {
            $order = wc_get_order($order_id);
            if ($order) {
                $order->update_meta_data('_yape_plin_operation', $operation);
                $order->save();
            }
        }
    }

    public static function admin_order_operation($order) {
        $operation = $order->get_meta('_yape_plin_operation');
        if (!$operation) return;
        echo '<p><strong>' . esc_html__('N.º de operación Yape:', 'edroz-qr-payments') . '</strong> ' . esc_html($operation) . '</p>';
    }

    public static function order_operation($order) {
        $operation = $order->get_meta('_yape_plin_operation');
        if (!$operation) return;
        echo '<p class="edroz-operation"><strong>' . esc_html__('N.º de operación:', 'edroz-qr-payments') . '</strong> ' . esc_html($operation) . '</p>';
    }
}

Edroz_Yape_Plin_Payment::init();
