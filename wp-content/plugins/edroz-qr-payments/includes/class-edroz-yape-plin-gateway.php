<?php
if (!defined('ABSPATH')) exit;

abstract class Edroz_Yape_Gateway_Base extends WC_Payment_Gateway {
    protected $brand;
    protected $field_prefix;

    public function __construct() {
        $this->id = $this->field_prefix;
        $this->has_fields = true;
        // WooCommerce usa $icon también en la lista de métodos de pago del administrador.
        // Conservamos los mismos logos que utilizaba el plugin original.
        $this->icon = plugins_url(
            'assets/images/yape.svg',
            dirname(__DIR__) . '/edroz-qr-payments.php'
        );
        $this->method_title = 'EDROZ - ' . $this->brand;
        $this->method_description = __('Pago manual mediante Yape. El cliente realiza el pago fuera de WooCommerce y el pedido queda pendiente de revisión.', 'edroz-qr-payments');
        $this->supports = array('products');
        $this->init_form_fields();
        $this->init_settings();
        $default_title = sprintf(
            /* translators: %s: payment method name. */
            __('Paga con %s', 'edroz-qr-payments'),
            $this->brand
        );
        $this->title = $this->get_option('title', $default_title);
        $this->description = $this->get_option('description', '');
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));
        add_action('woocommerce_email_before_order_table', array($this, 'email_instructions'), 10, 3);
    }

    protected function defaults() {
        $yape = $this->id === 'yapepay';
        return array(
            'title' => sprintf(
                /* translators: %s: payment method name. */
                __('Paga con %s', 'edroz-qr-payments'),
                $this->brand
            ),
            'description' => sprintf(
                /* translators: %s: payment method name. */
                __('Realiza tu pago con %s y registra el número de operación al finalizar.', 'edroz-qr-payments'),
                $this->brand
            ),
            'instructions' => sprintf(
                /* translators: %s: payment method name. */
                __('Gracias por tu pedido. Realiza el pago mediante %s y conserva tu comprobante. Tu pedido será revisado antes de ser procesado.', 'edroz-qr-payments'),
                $this->brand
            ),
            'holder' => '',
            'phone' => '',
            'company' => '',
            'tax_id' => '',
            'qr_url' => '',
            'show_copy' => 'yes',
            'show_contact' => 'yes',
            'show_qr' => 'yes',
            'operation_field' => 'yes',
            'operation_required' => 'no',
            'order_status' => 'on-hold',
            'after_html' => '',
            'legacy_html' => '',
            'enable_for_methods' => array(),
            'enable_for_virtual' => 'yes',
        );
    }

    public function init_form_fields() {
        $shipping_methods = array();
        if (is_admin() && function_exists('WC') && WC()->shipping()) {
            foreach (WC()->shipping()->load_shipping_methods() as $method) {
                $shipping_methods[$method->id] = $method->get_method_title();
            }
        }
        $d = $this->defaults();
        $this->form_fields = array(
            'enabled' => array('title'=>__('Activar', 'edroz-qr-payments'),'type'=>'checkbox','label'=>__('Activar este método de pago','edroz-qr-payments'),'default'=>'no'),
            'title' => array('title'=>__('Título','edroz-qr-payments'),'type'=>'text','default'=>$d['title'],'desc_tip'=>true,'description'=>__('Texto que verá el cliente en el checkout.','edroz-qr-payments')),
            'description' => array('title'=>__('Descripción','edroz-qr-payments'),'type'=>'textarea','default'=>$d['description'],'desc_tip'=>true,'description'=>__('Descripción mostrada al seleccionar Yape. Puedes usar texto o HTML.','edroz-qr-payments')),
            'holder' => array('title'=>__('Titular','edroz-qr-payments'),'type'=>'text','default'=>$d['holder'],'description'=>__('Nombre del titular de la cuenta.','edroz-qr-payments')),
            'phone' => array('title'=>__('Número de celular','edroz-qr-payments'),'type'=>'text','default'=>$d['phone'],'description'=>__('Número asociado a Yape.','edroz-qr-payments')),
            'company' => array('title'=>__('Empresa','edroz-qr-payments'),'type'=>'text','default'=>$d['company']),
            'tax_id' => array('title'=>__('RUC / documento','edroz-qr-payments'),'type'=>'text','default'=>$d['tax_id']),
            'qr_url' => array('title'=>__('Código QR','edroz-qr-payments'),'type'=>'text','default'=>$d['qr_url'],'description'=>__('Selecciona una imagen desde la Biblioteca de Medios.','edroz-qr-payments'),'desc_tip'=>true),
            'show_qr' => array('title'=>__('Mostrar QR','edroz-qr-payments'),'type'=>'checkbox','label'=>__('Mostrar el QR en checkout y página de pedido','edroz-qr-payments'),'default'=>'yes'),
            'show_copy' => array('title'=>__('Botón copiar','edroz-qr-payments'),'type'=>'checkbox','label'=>__('Mostrar botón para copiar el número','edroz-qr-payments'),'default'=>'yes'),
            'show_contact' => array('title'=>__('Añadir a contactos','edroz-qr-payments'),'type'=>'checkbox','label'=>__('Mostrar enlace para añadir/llamar al número','edroz-qr-payments'),'default'=>'yes'),
            'operation_field' => array('title'=>__('Número de operación','edroz-qr-payments'),'type'=>'checkbox','label'=>__('Solicitar número de operación en checkout','edroz-qr-payments'),'default'=>'yes'),
            'operation_required' => array('title'=>__('Obligatorio','edroz-qr-payments'),'type'=>'checkbox','label'=>__('Hacer obligatorio el número de operación','edroz-qr-payments'),'default'=>'no'),

            'order_status' => array('title'=>__('Estado inicial del pedido','edroz-qr-payments'),'type'=>'select','default'=>$d['order_status'],'options'=>array('on-hold'=>__('En espera','edroz-qr-payments'),'processing'=>__('Procesando','edroz-qr-payments')),'description'=>__('Para pagos manuales normalmente se recomienda “En espera”.','edroz-qr-payments')),
            'enable_for_methods' => array('title'=>__('Métodos de envío','edroz-qr-payments'),'type'=>'multiselect','class'=>'wc-enhanced-select','css'=>'width:450px;','default'=>$d['enable_for_methods'],'options'=>$shipping_methods,'desc_tip'=>true,'description'=>__('Déjalo vacío para permitirlo con cualquier método de envío.','edroz-qr-payments'),'custom_attributes'=>array('data-placeholder'=>__('Selecciona métodos','edroz-qr-payments'))),
            'enable_for_virtual' => array('title'=>__('Pedidos virtuales','edroz-qr-payments'),'type'=>'checkbox','label'=>__('Permitir también para pedidos sin envío','edroz-qr-payments'),'default'=>'yes'),
        );
    }

    public function admin_options() {
        parent::admin_options();
        wp_enqueue_media();
        wp_enqueue_script(
            'edroz-qr-payments-admin',
            plugins_url('../assets/js/admin-qr-media.js', __FILE__),
            array('jquery'),
            Edroz_Yape_Plin_Payment::VERSION,
            true
        );
        wp_localize_script(
            'edroz-qr-payments-admin',
            'EdrozQRMedia',
            array('gatewayId' => $this->id)
        );
    }

    public function get_option($key, $empty_value = null) {
        $value = parent::get_option($key, $empty_value);
        if ($value === '' || $value === null) {
            $legacy = 'yapepay_url';
            if ($key === 'legacy_html' && isset($this->settings[$legacy])) return $this->settings[$legacy];
        }
        return $value;
    }

    public function is_available() {
        if ($this->get_option('enable_for_virtual','yes') !== 'yes' && WC()->cart && !WC()->cart->needs_shipping()) return false;
        $methods = $this->get_option('enable_for_methods', array());
        if (!empty($methods) && WC()->cart && WC()->cart->needs_shipping()) {
            $chosen = WC()->session ? WC()->session->get('chosen_shipping_methods', array()) : array();
            $allowed = false;
            foreach ((array)$chosen as $method) {
                foreach ((array)$methods as $allowed_method) {
                    if (strpos($method, $allowed_method) === 0) { $allowed = true; break 2; }
                }
            }
            if (!$allowed) return false;
        }
        return parent::is_available();
    }

    public function payment_fields() {
        echo '<div class="edroz-payment-box edroz-' . esc_attr($this->id) . '">';
        if ($this->description) echo '<div class="edroz-payment-description">' . wp_kses_post(wpautop(wptexturize($this->description))) . '</div>';
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- render_card() escapes its dynamic output before returning the HTML markup.
        echo $this->render_card();
        if ($this->get_option('operation_field','yes') === 'yes') {
            $required = $this->get_option('operation_required','no') === 'yes';
            echo '<div class="edroz-operation-field"><label for="yape_plin_operation">' . esc_html__('Número de operación', 'edroz-qr-payments') . ($required ? ' <span class="required">*</span>' : '') . '</label>';
            echo '<input type="text" id="yape_plin_operation" name="yape_plin_operation" inputmode="numeric" autocomplete="off" placeholder="' . esc_attr__('Ej. 123456789', 'edroz-qr-payments') . '" ' . ($required ? 'required' : '') . ' />';
            echo '<small>' . esc_html__('Opcionalmente, escribe el número que aparece en tu comprobante.', 'edroz-qr-payments') . '</small></div>';
        }
        echo '</div>';
    }

    protected function render_card() {
        $phone = trim((string)$this->get_option('phone',''));
        $digits = preg_replace('/[^0-9+]/', '', $phone);
        $qr = trim((string)$this->get_option('qr_url',''));
        $brand_class = 'yape';
        $cart_total = 0;
        if (function_exists('WC') && WC()->cart) {
            $cart_total = (float) WC()->cart->get_total('edit');
        }
        $formatted_total = $cart_total > 0 ? wc_price($cart_total) : '';
        ob_start(); ?>
        <div class="edroz-card edroz-card-<?php echo esc_attr($brand_class); ?>">
            <?php if ($formatted_total): ?>
                <div class="edroz-amount" data-edroz-amount="<?php echo esc_attr(wc_format_decimal($cart_total, wc_get_price_decimals())); ?>">
                    <div class="edroz-amount-icon">✓</div>
                    <div class="edroz-amount-copy">
                        <span class="edroz-amount-label"><?php esc_html_e('Monto exacto a ingresar', 'edroz-qr-payments'); ?></span>
                        <strong class="edroz-amount-value"><?php echo wp_kses_post($formatted_total); ?></strong>
                        <small><?php esc_html_e('Escribe este mismo monto en Yape antes de confirmar tu pago.', 'edroz-qr-payments'); ?></small>
                    </div>
                </div>
            <?php endif; ?>
            <div class="edroz-steps" aria-label="<?php esc_attr_e('Pasos para pagar', 'edroz-qr-payments'); ?>">
                <div><span>1</span><strong><?php esc_html_e('Escanea', 'edroz-qr-payments'); ?></strong></div>
                <div><span>2</span><strong><?php esc_html_e('Ingresa el monto', 'edroz-qr-payments'); ?></strong></div>
                <div><span>3</span><strong><?php esc_html_e('Confirma', 'edroz-qr-payments'); ?></strong></div>
            </div>
            <div class="edroz-card-main">
                <?php if ($this->get_option('show_qr','yes') === 'yes' && $qr): ?>
                    <div class="edroz-qr-wrap"><img src="<?php echo esc_url($qr); ?>" alt="<?php
                    // translators: %s: payment method name.
                    echo esc_attr(sprintf(__('Código QR de %s', 'edroz-qr-payments'), $this->brand));
                    ?>" loading="lazy"></div>
                <?php endif; ?>
                <div class="edroz-data">
                    <span class="edroz-badge"><?php echo esc_html($this->brand); ?></span>
                    <div class="edroz-data-grid">
                        <?php if ($this->get_option('holder','')): ?><div><strong><?php esc_html_e('Titular','edroz-qr-payments'); ?></strong><span><?php echo esc_html($this->get_option('holder')); ?></span></div><?php endif; ?>
                        <?php if ($this->get_option('company','')): ?><div><strong><?php esc_html_e('Empresa','edroz-qr-payments'); ?></strong><span><?php echo esc_html($this->get_option('company')); ?></span></div><?php endif; ?>
                        <?php if ($this->get_option('tax_id','')): ?><div><strong><?php esc_html_e('RUC / documento','edroz-qr-payments'); ?></strong><span><?php echo esc_html($this->get_option('tax_id')); ?></span></div><?php endif; ?>
                        <?php if ($phone): ?><div class="edroz-phone"><strong><?php esc_html_e('Celular','edroz-qr-payments'); ?></strong><span class="edroz-number"><?php echo esc_html($phone); ?></span></div><?php endif; ?>
                    </div>
                    <div class="edroz-actions">
                        <?php if ($phone && $this->get_option('show_copy','yes') === 'yes'): ?><button type="button" class="edroz-copy" data-copy="<?php echo esc_attr($phone); ?>"><?php esc_html_e('Copiar número','edroz-qr-payments'); ?></button><?php endif; ?>
                        <?php if ($phone && $this->get_option('show_contact','yes') === 'yes'): ?><a class="edroz-contact" href="tel:<?php echo esc_attr($digits); ?>"><?php esc_html_e('Llamar / añadir contacto','edroz-qr-payments'); ?></a><?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="edroz-tip">💡 <?php esc_html_e('Después de pagar, registra tu número de operación para que podamos identificar tu pago más rápido.', 'edroz-qr-payments'); ?></div>
        </div>
        <?php return ob_get_clean();
    }

    public function process_payment($order_id) {
        $order = wc_get_order($order_id);
        if (!$order) return array('result'=>'failure');
        $status = $this->get_option('order_status','on-hold');
        $status_note = sprintf(
            /* translators: %s: payment method name. */
            __('Pago %s pendiente de verificación.', 'edroz-qr-payments'),
            $this->brand
        );
        $customer_note = sprintf(
            /* translators: %s: payment method name. */
            __('Cliente seleccionó %s.', 'edroz-qr-payments'),
            $this->brand
        );
        $order->update_status($status, $status_note);
        $order->add_order_note($customer_note);
        if (function_exists('wc_maybe_reduce_stock_levels')) wc_maybe_reduce_stock_levels($order_id);
        $order->save();
        Edroz_Yape_Plin_Payment::save_operation($order_id);
        if (WC()->cart) WC()->cart->empty_cart();
        return array('result'=>'success','redirect'=>$this->get_return_url($order));
    }

    public function thankyou_page($order_id) {
        // No repetimos las instrucciones del checkout en la página de agradecimiento.
        // WooCommerce muestra el resumen del pedido y el plugin conserva el N.º de operación.
    }

    public function email_instructions($order, $sent_to_admin, $plain_text = false) {
        $instructions = $this->get_option('instructions', '');
        if ($sent_to_admin || !$order instanceof WC_Order || $order->get_payment_method() !== $this->id || !$instructions) return;
        if ($plain_text) echo "\n" . esc_html(wp_strip_all_tags($instructions)) . "\n";
        else echo '<div>' . wp_kses_post(wpautop(wptexturize($instructions))) . '</div>';
    }
}

class Edroz_Yape_Gateway extends Edroz_Yape_Gateway_Base {
    protected $brand = 'Yape';
    protected $field_prefix = 'yapepay';
}
