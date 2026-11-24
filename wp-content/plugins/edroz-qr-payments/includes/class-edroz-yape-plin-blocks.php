<?php
if (!defined('ABSPATH')) exit;

if (class_exists('Automattic\\WooCommerce\\Blocks\\Payments\\Integrations\\AbstractPaymentMethodType')) {
    class Edroz_Yape_Blocks extends Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType {
        protected $name = 'yapepay';
        protected $settings = array();

        public function initialize() {
            $this->settings = get_option('woocommerce_' . $this->name . '_settings', array());
        }

        public function is_active() {
            return isset($this->settings['enabled']) && $this->settings['enabled'] === 'yes';
        }

        public function get_payment_method_script_handles() {
            $handle = 'edroz-' . $this->name . '-blocks';
            wp_register_script(
                $handle,
                plugins_url('../assets/js/blocks-payment.js', __FILE__),
                array('wc-blocks-registry', 'wc-settings', 'wp-element', 'wp-data'),
                Edroz_Yape_Plin_Payment::VERSION,
                true
            );
            return array($handle);
        }

        public function get_payment_method_data() {
            return array(
                'title' => isset($this->settings['title']) ? $this->settings['title'] : __('Paga con Yape', 'edroz-qr-payments'),
                'description' => isset($this->settings['description']) ? $this->settings['description'] : '',
                'holder' => isset($this->settings['holder']) ? $this->settings['holder'] : '',
                'phone' => isset($this->settings['phone']) ? $this->settings['phone'] : '',
                'company' => isset($this->settings['company']) ? $this->settings['company'] : '',
                'tax_id' => isset($this->settings['tax_id']) ? $this->settings['tax_id'] : '',
                'qr_url' => isset($this->settings['qr_url']) ? $this->settings['qr_url'] : '',
                'show_qr' => isset($this->settings['show_qr']) ? $this->settings['show_qr'] : 'yes',
                'show_copy' => isset($this->settings['show_copy']) ? $this->settings['show_copy'] : 'yes',
                'show_contact' => isset($this->settings['show_contact']) ? $this->settings['show_contact'] : 'yes',
                'operation_field' => isset($this->settings['operation_field']) ? $this->settings['operation_field'] : 'yes',
                'operation_required' => isset($this->settings['operation_required']) ? $this->settings['operation_required'] : 'no',
                'currency_code' => function_exists('get_woocommerce_currency') ? get_woocommerce_currency() : 'PEN',
                'icon' => plugins_url('../assets/images/yape.svg', __FILE__),
                'supports' => array('products'),
            );
        }
    }

    add_action('woocommerce_blocks_payment_method_type_registration', function($registry) {
        $registry->register(new Edroz_Yape_Blocks());
    });
}
