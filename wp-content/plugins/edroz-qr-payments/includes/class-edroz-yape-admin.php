<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Edroz_QR_Payments_Admin {
    const MENU_SLUG   = 'edroz-qr-payments';
    const PAYMENTS_SLUG = 'edroz-qr-payments-payments';
    const SUPPORT_URL = 'https://wa.me/51957868686?text=Hola%20Edroz%20Design%2C%20necesito%20ayuda%20con%20Edroz%20QR%20Payments.';
    const PRO_CONTACT_URL = 'https://wa.me/51957868686?text=Hola%20Edroz%20Design%2C%20estoy%20interesado%20en%20activar%20Plin%20y%20transferencias%20bancarias%20en%20Edroz%20QR%20Payments%20PRO.%20%C2%BFMe%20pueden%20brindar%20informaci%C3%B3n%3F';

    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'register_menu' ) );
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
        add_action( 'wp_ajax_edroz_qr_toggle_yape', array( __CLASS__, 'ajax_toggle_yape' ) );
        add_action( 'admin_post_edroz_qr_save_yape', array( __CLASS__, 'save_yape_settings' ) );
    }

    public static function register_menu() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            return;
        }

        add_menu_page(
            __( 'Edroz QR Payments', 'edroz-qr-payments' ),
            __( 'Edroz QR Payments', 'edroz-qr-payments' ),
            'manage_woocommerce',
            self::MENU_SLUG,
            array( __CLASS__, 'render_status' ),
            plugins_url( '../assets/images/yape.svg', __FILE__ ),
            56
        );

        add_submenu_page(
            self::MENU_SLUG,
            __( 'Estado', 'edroz-qr-payments' ),
            __( 'Estado', 'edroz-qr-payments' ),
            'manage_woocommerce',
            self::MENU_SLUG,
            array( __CLASS__, 'render_status' )
        );

        add_submenu_page(
            self::MENU_SLUG,
            __( 'Pagos', 'edroz-qr-payments' ),
            __( 'Pagos', 'edroz-qr-payments' ),
            'manage_woocommerce',
            self::PAYMENTS_SLUG,
            array( __CLASS__, 'render_payments' )
        );

        add_submenu_page(
            null,
            __( 'Configurar Yape', 'edroz-qr-payments' ),
            __( 'Configurar Yape', 'edroz-qr-payments' ),
            'manage_woocommerce',
            'edroz-qr-configure-yape',
            array( __CLASS__, 'render_yape_settings' )
        );

        add_submenu_page(
            self::MENU_SLUG,
            __( 'Ayuda por WhatsApp', 'edroz-qr-payments' ),
            __( 'Ayuda por WhatsApp', 'edroz-qr-payments' ),
            'manage_woocommerce',
            'edroz-qr-payments-support',
            array( __CLASS__, 'render_support' )
        );
    }

    public static function enqueue_assets( $hook ) {
        $allowed = array(
            'toplevel_page_' . self::MENU_SLUG,
            'edroz-qr-payments_page_' . self::PAYMENTS_SLUG,
            'edroz-qr-payments_page_edroz-qr-payments-support',
            'admin_page_edroz-qr-configure-yape',
        );

        if ( ! in_array( $hook, $allowed, true ) ) {
            return;
        }

        wp_enqueue_style(
            'edroz-qr-payments-admin',
            plugins_url( '../assets/css/admin.css', __FILE__ ),
            array(),
            Edroz_Yape_Plin_Payment::VERSION
        );

        wp_enqueue_script(
            'edroz-qr-payments-admin-dashboard',
            plugins_url( '../assets/js/admin-dashboard.js', __FILE__ ),
            array( 'jquery' ),
            Edroz_Yape_Plin_Payment::VERSION,
            true
        );

        wp_localize_script(
            'edroz-qr-payments-admin-dashboard',
            'EdrozQRAdmin',
            array(
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'edroz_qr_admin_nonce' ),
                'i18n'    => array(
                    'error' => __( 'No se pudo actualizar el método. Inténtalo nuevamente.', 'edroz-qr-payments' ),
                ),
            )
        );
    }

    public static function ajax_toggle_yape() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_send_json_error( array( 'message' => __( 'No tienes permisos para realizar esta acción.', 'edroz-qr-payments' ) ), 403 );
        }

        check_ajax_referer( 'edroz_qr_admin_nonce', 'nonce' );

        $enabled = isset( $_POST['enabled'] ) && 'yes' === sanitize_key( wp_unslash( $_POST['enabled'] ) ) ? 'yes' : 'no';
        $settings = get_option( 'woocommerce_yapepay_settings', array() );
        $settings = is_array( $settings ) ? $settings : array();
        $settings['enabled'] = $enabled;
        update_option( 'woocommerce_yapepay_settings', $settings );

        wp_send_json_success(
            array(
                'enabled' => $enabled,
                'label'   => 'yes' === $enabled ? __( 'Activo', 'edroz-qr-payments' ) : __( 'Inactivo', 'edroz-qr-payments' ),
            )
        );
    }

    private static function yape_settings() {
        $settings = get_option( 'woocommerce_yapepay_settings', array() );
        return is_array( $settings ) ? $settings : array();
    }

    private static function yape_enabled() {
        $settings = self::yape_settings();
        return isset( $settings['enabled'] ) && 'yes' === $settings['enabled'];
    }

    private static function badge( $enabled ) {
        if ( $enabled ) {
            return '<span class="edroz-status-badge is-active">' . esc_html__( 'Activo', 'edroz-qr-payments' ) . '</span>';
        }

        return '<span class="edroz-status-badge is-inactive">' . esc_html__( 'Inactivo', 'edroz-qr-payments' ) . '</span>';
    }

    private static function header( $title, $subtitle = '' ) {
        $logo = plugins_url( '../assets/images/yape.svg', __FILE__ );
        ?>
        <div class="edroz-admin-header">
            <div class="edroz-admin-brand">
                <div class="edroz-admin-logo"><img src="<?php echo esc_url( $logo ); ?>" alt=""></div>
                <div>
                    <h1><?php echo esc_html( $title ); ?></h1>
                    <?php if ( $subtitle ) : ?><p><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    public static function render_status() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_die( esc_html__( 'No tienes permisos para acceder a esta página.', 'edroz-qr-payments' ) );
        }

        $yape_enabled = self::yape_enabled();
        $woocommerce  = function_exists( 'WC' );
        $wc_version   = defined( 'WC_VERSION' ) ? WC_VERSION : '—';
        $wp_version   = get_bloginfo( 'version' );
        $php_version  = PHP_VERSION;
        $logo         = plugins_url( '../assets/images/yape.svg', __FILE__ );
        $attention    = ! $woocommerce || ! $yape_enabled;
        $payments_url = admin_url( 'admin.php?page=' . self::PAYMENTS_SLUG );
        ?>
        <div class="wrap edroz-admin-wrap edroz-status-modern">
            <section class="edroz-status-hero">
                <div class="edroz-status-hero-copy">
                    <span class="edroz-status-eyebrow">EDROZ DESIGN · QR PAYMENTS</span>
                    <h1><?php esc_html_e( 'Estado del sistema', 'edroz-qr-payments' ); ?></h1>
                    <p><?php esc_html_e( 'Todo lo importante de tu instalación, en un solo lugar.', 'edroz-qr-payments' ); ?></p>
                </div>
                <div class="edroz-status-hero-side">
                    <span class="edroz-system-pill <?php echo $attention ? 'is-warning' : 'is-good'; ?>"><i></i><?php echo $attention ? esc_html__( 'Requiere atención', 'edroz-qr-payments' ) : esc_html__( 'Todo funcionando', 'edroz-qr-payments' ); ?></span>
                    <small><?php echo esc_html( 'v' . Edroz_Yape_Plin_Payment::VERSION ); ?></small>
                </div>
                <span class="edroz-hero-orbit" aria-hidden="true"></span>
            </section>

            <section class="edroz-status-cards">
                <article class="edroz-modern-card edroz-system-card">
                    <div class="edroz-modern-card-top"><span class="edroz-modern-kicker"><?php esc_html_e( 'PLUGIN Y TIENDA', 'edroz-qr-payments' ); ?></span><span class="edroz-modern-icon is-purple">✦</span></div>
                    <h2><?php esc_html_e( 'Edroz QR Payments', 'edroz-qr-payments' ); ?></h2>
                    <div class="edroz-info-line"><span><?php esc_html_e( 'Versión instalada', 'edroz-qr-payments' ); ?></span><strong><?php echo esc_html( 'v' . Edroz_Yape_Plin_Payment::VERSION ); ?></strong></div>
                    <div class="edroz-info-line"><span>WordPress</span><strong><?php echo esc_html( $wp_version ); ?></strong></div>
                    <div class="edroz-info-line"><span>WooCommerce</span><strong class="<?php echo $woocommerce ? 'is-text-good' : 'is-text-warning'; ?>"><?php echo esc_html( $wc_version ); ?></strong></div>
                    <div class="edroz-info-line"><span>PHP</span><strong><?php echo esc_html( $php_version ); ?></strong></div>
                </article>

                <article class="edroz-modern-card edroz-yape-status-card">
                    <div class="edroz-modern-card-top"><span class="edroz-modern-kicker"><?php esc_html_e( 'MÉTODO DE PAGO', 'edroz-qr-payments' ); ?></span><span class="edroz-modern-icon is-green">✓</span></div>
                    <div class="edroz-yape-status-heading"><img src="<?php echo esc_url( $logo ); ?>" alt="Yape"><div><h2>Yape</h2><?php echo wp_kses_post( self::badge( $yape_enabled ) ); ?></div></div>
                    <p class="edroz-modern-description"><?php echo $yape_enabled ? esc_html__( 'Tu método de pago está habilitado para recibir pedidos.', 'edroz-qr-payments' ) : esc_html__( 'Activa Yape para que tus clientes puedan seleccionarlo al pagar.', 'edroz-qr-payments' ); ?></p>
                    <a class="edroz-modern-link" href="<?php echo esc_url( $payments_url ); ?>"><?php esc_html_e( 'Administrar Yape', 'edroz-qr-payments' ); ?> <span>→</span></a>
                </article>

                <article class="edroz-modern-card edroz-support-modern-card">
                    <div class="edroz-modern-card-top"><span class="edroz-modern-kicker"><?php esc_html_e( 'SOPORTE', 'edroz-qr-payments' ); ?></span><span class="edroz-modern-icon is-green">◉</span></div>
                    <h2><?php esc_html_e( 'Atención por WhatsApp', 'edroz-qr-payments' ); ?></h2>
                    <div class="edroz-support-status"><span class="edroz-support-dot"></span><div><strong><?php esc_html_e( '¿Necesitas ayuda?', 'edroz-qr-payments' ); ?></strong><small><?php esc_html_e( 'Te acompañamos con la configuración de Yape.', 'edroz-qr-payments' ); ?></small></div></div>
                    <p class="edroz-modern-description"><?php esc_html_e( 'Resuelve tus dudas de instalación y puesta en marcha directamente con nuestro equipo.', 'edroz-qr-payments' ); ?></p>
                    <a class="edroz-whatsapp-btn" href="<?php echo esc_url( self::SUPPORT_URL ); ?>" target="_blank" rel="noopener noreferrer"><span class="dashicons dashicons-whatsapp"></span><?php esc_html_e( 'Contactar por WhatsApp', 'edroz-qr-payments' ); ?> <span>↗</span></a>
                </article>

                <article class="edroz-modern-card edroz-summary-modern-card">
                    <div class="edroz-modern-card-top"><span class="edroz-modern-kicker"><?php esc_html_e( 'RESUMEN', 'edroz-qr-payments' ); ?></span><span class="edroz-modern-icon is-neutral">◎</span></div>
                    <h2><?php esc_html_e( 'Tu instalación', 'edroz-qr-payments' ); ?></h2>
                    <div class="edroz-health-grid">
                        <div class="<?php echo $yape_enabled ? 'is-ok' : 'is-pending'; ?>"><span><?php echo $yape_enabled ? '✓' : '•'; ?></span><?php esc_html_e( 'Yape', 'edroz-qr-payments' ); ?> · <?php echo $yape_enabled ? esc_html__( 'Activo', 'edroz-qr-payments' ) : esc_html__( 'Inactivo', 'edroz-qr-payments' ); ?></div>
                        <div class="<?php echo $woocommerce ? 'is-ok' : 'is-pending'; ?>"><span><?php echo $woocommerce ? '✓' : '•'; ?></span><?php esc_html_e( 'WooCommerce', 'edroz-qr-payments' ); ?> · <?php echo $woocommerce ? esc_html__( 'Conectado', 'edroz-qr-payments' ) : esc_html__( 'No disponible', 'edroz-qr-payments' ); ?></div>
                        <div class="is-ok"><span>✓</span><?php esc_html_e( 'Edroz QR Payments', 'edroz-qr-payments' ); ?> · <?php esc_html_e( 'Instalado', 'edroz-qr-payments' ); ?></div>
                        <div class="is-neutral"><span>i</span><?php esc_html_e( 'Edición', 'edroz-qr-payments' ); ?> · FREE</div>
                    </div>
                </article>
            </section>
            <?php
            $usage_settings = self::yape_settings();
            $discount_value = isset( $usage_settings['yape_discount_percent'] ) ? (float) $usage_settings['yape_discount_percent'] : 0;
            $timer_value = isset( $usage_settings['payment_timer_minutes'] ) ? absint( $usage_settings['payment_timer_minutes'] ) : 0;
            $is_pro = class_exists( 'Edroz_QR_Usage' ) && Edroz_QR_Usage::is_pro();
            ?>
            <section class="edroz-modern-card" style="margin-top:18px;padding:22px;">
                <div class="edroz-modern-card-top"><span class="edroz-modern-kicker">EDROZ FREE / PRO</span><span class="edroz-modern-icon is-purple">◎</span></div>
                <h2><?php esc_html_e( 'Tu consumo y herramientas', 'edroz-qr-payments' ); ?></h2>
                <p class="edroz-modern-description"><?php esc_html_e( 'Consulta tus pruebas gratuitas y administra las herramientas sin salir del panel Edroz.', 'edroz-qr-payments' ); ?></p>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(155px,1fr));gap:12px;margin:18px 0;">
                    <?php foreach ( array( 'discount' => array( 'Descuentos Yape', 50 ), 'timer' => array( 'Temporizador', 50 ), 'whatsapp' => array( 'WhatsApp', 50 ), 'bulk' => array( 'Acciones masivas', 20 ) ) as $feature => $item ) :
                        $used = class_exists( 'Edroz_QR_Usage' ) ? Edroz_QR_Usage::used( $feature ) : 0;
                        $limit = (int) $item[1];
                        $remaining = max( 0, $limit - $used ); ?>
                        <div style="background:#f8f7fc;border:1px solid #ece8f5;border-radius:10px;padding:14px;">
                            <strong style="display:block;font-size:13px;margin-bottom:7px;"><?php echo esc_html( $item[0] ); ?></strong>
                            <span style="font-size:20px;font-weight:700;color:#5420a8;"><?php echo $is_pro ? '∞' : esc_html( $used . ' / ' . $limit ); ?></span>
                            <small style="display:block;color:#777;margin-top:4px;"><?php echo $is_pro ? esc_html__( 'PRO activo', 'edroz-qr-payments' ) : esc_html( $used . ' utilizados · ' . $remaining . ' disponibles' ); ?></small>
                        </div>
                    <?php endforeach; ?>
                    <div style="background:#f8f7fc;border:1px solid #ece8f5;border-radius:10px;padding:14px;"><strong style="display:block;font-size:13px;margin-bottom:7px;">Estadísticas avanzadas</strong><span style="font-size:20px;font-weight:700;color:#5420a8;"><?php echo $is_pro ? '∞' : esc_html( Edroz_QR_Usage::stats_days_left() . ' / 30 días' ); ?></span><small style="display:block;color:#777;margin-top:4px;">Prueba gratuita</small></div>
                </div>
                <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:center;border-top:1px solid #eee;padding-top:16px;">
                    <div style="flex:1;min-width:220px;"><strong><?php esc_html_e( 'Configuración rápida de Yape', 'edroz-qr-payments' ); ?></strong><p style="margin:5px 0 0;color:#777;">Descuento: <?php echo esc_html( $discount_value ); ?>% · Temporizador: <?php echo esc_html( $timer_value ); ?> min</p></div>
                    <a class="button button-primary" href="<?php echo esc_url( admin_url( 'admin.php?page=edroz-qr-configure-yape' ) ); ?>"><?php esc_html_e( 'Configurar desde Edroz', 'edroz-qr-payments' ); ?></a>
                </div>
            </section>
            <p class="edroz-status-footer"><span>Edroz QR Payments · <strong>Edroz Design</strong></span><span><?php esc_html_e( 'Gracias por confiar en nosotros.', 'edroz-qr-payments' ); ?></span></p>
        </div>
        <?php
    }

    public static function render_payments() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_die( esc_html__( 'No tienes permisos para acceder a esta página.', 'edroz-qr-payments' ) );
        }

        $enabled      = self::yape_enabled();
        $settings     = self::yape_settings();
        $logo         = plugins_url( '../assets/images/yape.svg', __FILE__ );
        $settings_url = admin_url( 'admin.php?page=edroz-qr-configure-yape' );
        $phone        = isset( $settings['phone'] ) ? $settings['phone'] : '';
        $qr_url       = isset( $settings['qr_url'] ) ? $settings['qr_url'] : '';
        ?>
        <div class="wrap edroz-admin-wrap edroz-payments-modern">
            <section class="edroz-payments-hero">
                <div>
                    <span class="edroz-payments-eyebrow">EDROZ DESIGN</span>
                    <h1><?php esc_html_e( 'Yape', 'edroz-qr-payments' ); ?> <span>FREE</span></h1>
                    <p><?php esc_html_e( 'Pagos simples. Más ventas para tu negocio.', 'edroz-qr-payments' ); ?></p>
                </div>
                <div class="edroz-payments-hero-status">
                    <span class="edroz-hero-license"><i></i><?php esc_html_e( 'Versión gratuita', 'edroz-qr-payments' ); ?></span>
                    <small><?php echo esc_html( 'v' . Edroz_Yape_Plin_Payment::VERSION ); ?></small>
                </div>
                <span class="edroz-payments-orbit" aria-hidden="true"></span>
            </section>

            <section class="edroz-payments-summary">
                <article><span class="edroz-summary-icon is-purple">▣</span><div><strong>1</strong><small><?php esc_html_e( 'Método disponible', 'edroz-qr-payments' ); ?></small></div></article>
                <article><span class="edroz-summary-icon is-green">✓</span><div><strong>Yape</strong><small><?php esc_html_e( 'Pago móvil', 'edroz-qr-payments' ); ?></small></div></article>
                <article><span class="edroz-summary-icon is-blue">⌁</span><div><strong><?php echo $enabled ? esc_html__( 'Activo', 'edroz-qr-payments' ) : esc_html__( 'Inactivo', 'edroz-qr-payments' ); ?></strong><small><?php esc_html_e( 'Estado del método', 'edroz-qr-payments' ); ?></small></div></article>
                <article><span class="edroz-summary-icon is-orange">◉</span><div><strong><?php esc_html_e( 'Soporte', 'edroz-qr-payments' ); ?></strong><small><?php esc_html_e( 'Atención por WhatsApp', 'edroz-qr-payments' ); ?></small></div></article>
                <article class="edroz-summary-note"><strong><?php esc_html_e( 'Todo desde aquí', 'edroz-qr-payments' ); ?></strong><small><?php esc_html_e( 'Activa y configura Yape desde tu panel.', 'edroz-qr-payments' ); ?></small></article>
            </section>

            <section class="edroz-payments-section-intro">
                <div><span><?php esc_html_e( 'MÉTODOS DE PAGO', 'edroz-qr-payments' ); ?></span><h2><?php esc_html_e( 'Configura tus cobros', 'edroz-qr-payments' ); ?></h2><p><?php esc_html_e( 'Administra Yape y revisa cómo aparecerá en el checkout de tu tienda.', 'edroz-qr-payments' ); ?></p></div>
                <a href="<?php echo esc_url( self::SUPPORT_URL ); ?>" target="_blank" rel="noopener noreferrer" class="edroz-payments-help">? <?php esc_html_e( '¿Necesitas ayuda?', 'edroz-qr-payments' ); ?></a>
            </section>

            <article class="edroz-free-yape-card">
                <div class="edroz-free-yape-main">
                    <div class="edroz-free-yape-logo"><img src="<?php echo esc_url( $logo ); ?>" alt="Yape"></div>
                    <div class="edroz-free-yape-copy">
                        <div class="edroz-free-yape-title"><h2>Yape</h2><span><?php esc_html_e( 'Recomendado', 'edroz-qr-payments' ); ?></span></div>
                        <p><?php esc_html_e( 'Recibe pagos con Yape de forma fácil y segura.', 'edroz-qr-payments' ); ?></p>
                        <small><?php esc_html_e( 'Tus clientes pueden pagar escaneando tu código QR o usando tu número afiliado.', 'edroz-qr-payments' ); ?></small>
                    </div>
                    <label class="edroz-switch" aria-label="<?php esc_attr_e( 'Activar Yape', 'edroz-qr-payments' ); ?>">
                        <input type="checkbox" class="edroz-yape-toggle" <?php checked( $enabled ); ?> data-enabled="<?php echo $enabled ? 'yes' : 'no'; ?>">
                        <span class="edroz-slider"></span>
                    </label>
                    <span class="edroz-free-yape-state" data-status><?php echo $enabled ? esc_html__( 'Activo', 'edroz-qr-payments' ) : esc_html__( 'Inactivo', 'edroz-qr-payments' ); ?></span>
                    <a class="edroz-free-config-button" href="<?php echo esc_url( $settings_url ); ?>"><?php esc_html_e( 'Configurar', 'edroz-qr-payments' ); ?> <span>→</span></a>
                </div>
                <div class="edroz-free-yape-meta">
                    <div><b>♧</b><span><?php esc_html_e( 'Número afiliado', 'edroz-qr-payments' ); ?><small><?php echo esc_html( $phone ? $phone : '—' ); ?></small></span></div>
                    <div><b>▦</b><span><?php esc_html_e( 'Código QR', 'edroz-qr-payments' ); ?><small><?php echo esc_html( $qr_url ? __( 'Configurado', 'edroz-qr-payments' ) : __( 'Pendiente', 'edroz-qr-payments' ) ); ?></small></span></div>
                    <div><b>T</b><span><?php esc_html_e( 'Título y descripción', 'edroz-qr-payments' ); ?><small><?php esc_html_e( 'Configuración', 'edroz-qr-payments' ); ?></small></span></div>
                    <div><b>◎</b><span><?php esc_html_e( 'Vista previa', 'edroz-qr-payments' ); ?><small><?php esc_html_e( 'Checkout', 'edroz-qr-payments' ); ?></small></span></div>
                </div>
            </article>

            <section class="edroz-pro-methods">
                <div class="edroz-pro-methods-heading"><div><span>AMPLÍA TUS COBROS</span><h2>Más métodos disponibles con PRO</h2><p>Activa más alternativas de pago para tus clientes.</p></div><b>EDROZ PRO</b></div>
                <div class="edroz-pro-method-grid">
                    <article class="edroz-pro-method-card"><div class="edroz-pro-method-logo is-plin">P</div><div><h3>Plin <span>PRO</span></h3><p>Recibe pagos mediante Plin y administra sus operaciones.</p></div><button type="button" class="edroz-pro-config" data-method="Plin">Configurar <span>🔒</span></button></article>
                    <article class="edroz-pro-method-card"><div class="edroz-pro-method-logo is-bank">▤</div><div><h3>Transferencias bancarias <span>PRO</span></h3><p>Configura tus cuentas bancarias y muestra los datos al cliente.</p></div><button type="button" class="edroz-pro-config" data-method="Transferencias bancarias">Configurar <span>🔒</span></button></article>
                </div>
                <div class="edroz-pro-modal" hidden><div class="edroz-pro-modal-card"><button type="button" class="edroz-pro-modal-close" aria-label="Cerrar">×</button><span class="edroz-pro-lock">🔒</span><h2>Función exclusiva PRO</h2><p class="edroz-pro-modal-message">Amplía tus opciones de cobro con Edroz QR Payments PRO.</p><a href="<?php echo esc_url( self::PRO_CONTACT_URL ); ?>" target="_blank" rel="noopener noreferrer">Consultar por WhatsApp ↗</a></div></div>
            </section>

            <section class="edroz-free-whatsapp">
                <div class="edroz-free-whatsapp-icon"><span class="dashicons dashicons-whatsapp"></span></div>
                <div class="edroz-free-whatsapp-copy"><span><?php esc_html_e( 'SOPORTE', 'edroz-qr-payments' ); ?></span><h2><?php esc_html_e( 'Soporte por WhatsApp', 'edroz-qr-payments' ); ?></h2><p><?php esc_html_e( '¿Tienes alguna duda o necesitas ayuda? Escríbenos y te acompañamos con la configuración de Yape.', 'edroz-qr-payments' ); ?></p></div>
                <div class="edroz-free-whatsapp-action"><strong><?php esc_html_e( 'Atención directa', 'edroz-qr-payments' ); ?></strong><small><?php esc_html_e( 'Te ayudamos con la configuración y resolvemos tus dudas.', 'edroz-qr-payments' ); ?></small><a href="<?php echo esc_url( self::SUPPORT_URL ); ?>" target="_blank" rel="noopener noreferrer"><span class="dashicons dashicons-whatsapp"></span><?php esc_html_e( 'Abrir WhatsApp', 'edroz-qr-payments' ); ?> ↗</a></div>
            </section>
            <p class="edroz-payments-footer"><span>Yape FREE | <strong>Desarrollado por Edroz ♥</strong></span><span><?php esc_html_e( 'Configura Yape, descuentos y temporizador desde este panel.', 'edroz-qr-payments' ); ?></span></p>
        </div>
        <?php
    }

    public static function save_yape_settings() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_die( esc_html__( 'No tienes permisos para realizar esta acción.', 'edroz-qr-payments' ) );
        }
        check_admin_referer( 'edroz_qr_save_yape' );
        $settings = self::yape_settings();
        $text_fields = array( 'title', 'phone', 'holder', 'company', 'tax_id', 'qr_url' );
        foreach ( $text_fields as $field ) {
            $settings[ $field ] = isset( $_POST[ $field ] ) ? sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) : '';
        }
        $settings['description'] = isset( $_POST['description'] ) ? sanitize_textarea_field( wp_unslash( $_POST['description'] ) ) : '';
        foreach ( array( 'show_qr', 'show_copy', 'show_contact', 'operation_field', 'operation_required' ) as $checkbox ) {
            $settings[ $checkbox ] = isset( $_POST[ $checkbox ] ) ? 'yes' : 'no';
        }
        $settings['yape_discount_percent'] = isset( $_POST['yape_discount_percent'] ) ? min( 50, max( 0, (float) sanitize_text_field( wp_unslash( $_POST['yape_discount_percent'] ) ) ) ) : 0;
        $settings['payment_timer_minutes'] = isset( $_POST['payment_timer_minutes'] ) ? min( 180, max( 0, absint( $_POST['payment_timer_minutes'] ) ) ) : 0;
        update_option( 'woocommerce_yapepay_settings', $settings );
        // Store a one-time success notice without relying on an unverified query parameter.
        set_transient( 'edroz_qr_yape_saved_' . get_current_user_id(), 1, MINUTE_IN_SECONDS );
        wp_safe_redirect( add_query_arg( array( 'page' => 'edroz-qr-configure-yape' ), admin_url( 'admin.php' ) ) );
        exit;
    }

    public static function render_yape_settings() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_die( esc_html__( 'No tienes permisos para acceder a esta página.', 'edroz-qr-payments' ) );
        }
        $s = self::yape_settings();
        $defaults = array( 'title' => 'Paga con Yape', 'phone' => '', 'holder' => '', 'company' => '', 'tax_id' => '', 'description' => 'Escanee nuestro QR con su aplicación Yape, o agregue nuestro número celular a sus contactos y realice su pago con Yape.', 'qr_url' => '', 'show_qr' => 'yes', 'show_copy' => 'yes', 'show_contact' => 'yes', 'operation_field' => 'yes', 'operation_required' => 'no', 'yape_discount_percent' => '0', 'payment_timer_minutes' => '0' );
        $s = wp_parse_args( $s, $defaults );
        $saved_notice_key = 'edroz_qr_yape_saved_' . get_current_user_id();
        $show_saved_notice = (bool) get_transient( $saved_notice_key );
        if ( $show_saved_notice ) {
            delete_transient( $saved_notice_key );
        }
        $logo = plugins_url( '../assets/images/yape.svg', __FILE__ );
        wp_enqueue_media();
        wp_enqueue_script( 'edroz-qr-payments-admin', plugins_url( '../assets/js/admin-qr-media.js', __FILE__ ), array( 'jquery' ), Edroz_Yape_Plin_Payment::VERSION, true );
        wp_localize_script( 'edroz-qr-payments-admin', 'EdrozQRMedia', array( 'gatewayId' => 'yapepay' ) );
        ?>
        <div class="wrap edroz-admin-wrap edroz-yape-settings-wrap">
            <div class="edroz-yape-settings-card">
                <div class="edroz-yape-settings-head">
                    <div class="edroz-yape-brand"><img src="<?php echo esc_url( $logo ); ?>" alt="Yape"><div><h1>Yape <span class="edroz-recommended"><?php esc_html_e( 'Recomendado', 'edroz-qr-payments' ); ?></span></h1><p><?php esc_html_e( 'Recibe pagos de forma fácil y segura.', 'edroz-qr-payments' ); ?></p><small><?php esc_html_e( 'Tus clientes pueden pagar desde su app de Yape escaneando tu código QR o usando tu número afiliado.', 'edroz-qr-payments' ); ?></small></div></div>
                    <a class="button edroz-outline-button" href="<?php echo esc_url( admin_url( 'admin.php?page=edroz-qr-payments-payments' ) ); ?>">← <?php esc_html_e( 'Volver a pagos', 'edroz-qr-payments' ); ?></a>
                </div>
                <div class="edroz-yape-meta"><div><b>▣</b><span><?php esc_html_e( 'Número afiliado', 'edroz-qr-payments' ); ?><small><?php echo esc_html( $s['phone'] ? $s['phone'] : '—' ); ?></small></span></div><div><b>▦</b><span><?php esc_html_e( 'Código QR', 'edroz-qr-payments' ); ?><small><?php echo esc_html( $s['qr_url'] ? __( 'Configurado', 'edroz-qr-payments' ) : __( 'Pendiente', 'edroz-qr-payments' ) ); ?></small></span></div><div><b>T</b><span><?php esc_html_e( 'Título y descripción', 'edroz-qr-payments' ); ?><small><?php esc_html_e( 'Configuración del checkout', 'edroz-qr-payments' ); ?></small></span></div><div><b>◎</b><span><?php esc_html_e( 'Vista previa', 'edroz-qr-payments' ); ?><small><?php esc_html_e( 'Checkout', 'edroz-qr-payments' ); ?></small></span></div></div>
                <?php if ( $show_saved_notice ) : ?><div class="notice notice-success is-dismissible"><p><?php esc_html_e( 'La configuración de Yape se guardó correctamente.', 'edroz-qr-payments' ); ?></p></div><?php endif; ?>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="edroz-yape-form">
                    <input type="hidden" name="action" value="edroz_qr_save_yape"><?php wp_nonce_field( 'edroz_qr_save_yape' ); ?>
                    <div class="edroz-yape-fields">
                        <?php self::text_field( 'title', __( 'Título del método', 'edroz-qr-payments' ), $s['title'] ); ?>
                        <?php self::text_field( 'phone', __( 'Número afiliado', 'edroz-qr-payments' ), $s['phone'] ); ?>
                        <?php self::text_field( 'holder', __( 'Titular', 'edroz-qr-payments' ), $s['holder'] ); ?>
                        <?php self::text_field( 'company', __( 'Empresa', 'edroz-qr-payments' ), $s['company'] ); ?>
                        <?php self::text_field( 'tax_id', __( 'RUC / documento', 'edroz-qr-payments' ), $s['tax_id'] ); ?>
                        <label class="edroz-field edroz-field-full"><span><?php esc_html_e( 'Descripción', 'edroz-qr-payments' ); ?></span><textarea name="description" rows="3"><?php echo esc_textarea( $s['description'] ); ?></textarea></label>
                        <div class="edroz-field edroz-field-full"><span><?php esc_html_e( 'Código QR', 'edroz-qr-payments' ); ?></span><div class="edroz-qr-picker"><input type="url" name="qr_url" value="<?php echo esc_attr( $s['qr_url'] ); ?>" placeholder="https://..."><button type="button" class="button edroz-media-button"><?php esc_html_e( 'Elegir imagen', 'edroz-qr-payments' ); ?></button></div><?php if ( $s['qr_url'] ) : ?><img class="edroz-qr-preview" src="<?php echo esc_url( $s['qr_url'] ); ?>" alt="<?php esc_attr_e( 'Vista previa del código QR', 'edroz-qr-payments' ); ?>"><?php endif; ?></div>
                    </div>
                    <div class="edroz-yape-extra-settings">
                        <div class="edroz-yape-extra-heading"><span>HERRAMIENTAS DE CONVERSIÓN</span><h2>Descuento y tiempo de pago</h2><p>Configura estas opciones sin salir del panel Edroz.</p></div>
                        <div class="edroz-yape-extra-grid">
                            <label class="edroz-field"><span>Descuento por pagar con Yape (%)</span><input type="number" name="yape_discount_percent" min="0" max="50" step="0.1" value="<?php echo esc_attr( isset( $s['yape_discount_percent'] ) ? $s['yape_discount_percent'] : '0' ); ?>"><small>Usa 0 para desactivarlo. Máximo 50%.</small></label>
                            <label class="edroz-field"><span>Temporizador de pago (minutos)</span><input type="number" name="payment_timer_minutes" min="0" max="180" step="1" value="<?php echo esc_attr( isset( $s['payment_timer_minutes'] ) ? $s['payment_timer_minutes'] : '0' ); ?>"><small>Usa 0 para desactivarlo. Es informativo; no cancela pedidos.</small></label>
                        </div>
                    </div>
                    <div class="edroz-yape-options">
                        <?php self::checkbox_field( 'show_qr', __( 'Mostrar código QR en el checkout', 'edroz-qr-payments' ), $s ); ?>
                        <?php self::checkbox_field( 'show_copy', __( 'Mostrar botón para copiar el número', 'edroz-qr-payments' ), $s ); ?>
                        <?php self::checkbox_field( 'show_contact', __( 'Mostrar opción para agregar a contactos', 'edroz-qr-payments' ), $s ); ?>
                        <?php self::checkbox_field( 'operation_field', __( 'Solicitar número de operación', 'edroz-qr-payments' ), $s ); ?>
                        <?php self::checkbox_field( 'operation_required', __( 'Hacer obligatorio el número de operación', 'edroz-qr-payments' ), $s ); ?>
                    </div>
                    <div class="edroz-yape-form-footer"><p><?php esc_html_e( 'Los cambios se aplicarán al checkout de WooCommerce.', 'edroz-qr-payments' ); ?></p><button type="submit" class="button button-primary button-large"><?php esc_html_e( 'Guardar cambios', 'edroz-qr-payments' ); ?></button></div>
                </form>
            </div>
        </div>
        <?php
    }

    private static function text_field( $name, $label, $value ) {
        printf( '<label class="edroz-field"><span>%1$s</span><input type="text" name="%2$s" value="%3$s"></label>', esc_html( $label ), esc_attr( $name ), esc_attr( $value ) );
    }

    private static function checkbox_field( $name, $label, $settings ) {
        printf( '<label class="edroz-option"><input type="checkbox" name="%1$s" value="yes" %2$s><span>%3$s</span></label>', esc_attr( $name ), checked( isset( $settings[ $name ] ) && 'yes' === $settings[ $name ], true, false ), esc_html( $label ) );
    }

    public static function render_support() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_die( esc_html__( 'No tienes permisos para acceder a esta página.', 'edroz-qr-payments' ) );
        }
        ?>
        <div class="wrap edroz-admin-wrap">
            <?php self::header( __( 'Ayuda', 'edroz-qr-payments' ), __( 'Estamos para ayudarte con la configuración de Edroz QR Payments.', 'edroz-qr-payments' ) ); ?>
            <div class="edroz-admin-card edroz-help-card">
                <div class="edroz-help-icon"><span class="dashicons dashicons-whatsapp"></span></div>
                <h2><?php esc_html_e( 'Soporte por WhatsApp', 'edroz-qr-payments' ); ?></h2>
                <p><?php esc_html_e( 'Si necesitas ayuda para configurar Yape, revisamos contigo la instalación y el checkout.', 'edroz-qr-payments' ); ?></p>
                <a class="edroz-whatsapp-btn edroz-whatsapp-large" href="<?php echo esc_url( self::SUPPORT_URL ); ?>" target="_blank" rel="noopener noreferrer">
                    <span class="dashicons dashicons-whatsapp"></span>
                    <?php esc_html_e( 'Contactar soporte', 'edroz-qr-payments' ); ?>
                </a>
            </div>
        </div>
        <?php
    }
}

Edroz_QR_Payments_Admin::init();
