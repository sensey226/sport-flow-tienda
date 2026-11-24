<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/** Manual review screen for Yape orders. */
final class Edroz_Yape_Reviews {
    const MENU_SLUG = 'edroz-yape-reviews';
    const META_STATUS = '_edroz_yape_review_status';
    const META_NOTE = '_edroz_yape_review_note';
    const META_HISTORY = '_edroz_yape_review_history';

    public static function init() {
        add_action( 'admin_post_edroz_yape_review', array( __CLASS__, 'handle_review' ) );
        add_action( 'admin_post_edroz_yape_export', array( __CLASS__, 'export_csv' ) );
        add_action( 'admin_post_edroz_yape_bulk_review', array( __CLASS__, 'handle_bulk_review' ) );
    }

    public static function register_menu() {
        add_submenu_page(
            'edroz-qr-payments',
            __( 'Verificar pagos Yape', 'edroz-qr-payments' ),
            __( 'Verificar pagos', 'edroz-qr-payments' ),
            'manage_woocommerce',
            self::MENU_SLUG,
            array( __CLASS__, 'render_page' )
        );
    }

    public static function enqueue_assets( $hook ) {
        if ( 'edroz-qr-payments_page_' . self::MENU_SLUG !== $hook ) {
            return;
        }
        wp_enqueue_style(
            'edroz-yape-reviews',
            plugins_url( '../assets/css/yape-reviews.css', __FILE__ ),
            array(),
            Edroz_Yape_Plin_Payment::VERSION
        );
    }

    public static function handle_review() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_die( esc_html__( 'No tienes permisos para realizar esta acción.', 'edroz-qr-payments' ) );
        }
        check_admin_referer( 'edroz_yape_review_order' );

        $order_id = isset( $_POST['order_id'] ) ? absint( $_POST['order_id'] ) : 0;
        $decision = isset( $_POST['decision'] ) ? sanitize_key( wp_unslash( $_POST['decision'] ) ) : '';
        $note     = isset( $_POST['review_note'] ) ? sanitize_textarea_field( wp_unslash( $_POST['review_note'] ) ) : '';
        $order    = wc_get_order( $order_id );

        if ( ! $order || 'yapepay' !== $order->get_payment_method() || ! in_array( $decision, array( 'approved', 'rejected' ), true ) ) {
            wp_die( esc_html__( 'No se pudo verificar este pedido.', 'edroz-qr-payments' ) );
        }

        // Reject repeated decisions and stale browser tabs.
        if ( in_array( $order->get_meta( self::META_STATUS, true ), array( 'approved', 'rejected' ), true ) || ! $order->has_status( array( 'pending', 'on-hold', 'failed' ) ) ) {
            wp_die( esc_html__( 'Este pedido ya fue revisado o no admite verificación. Actualiza la página.', 'edroz-qr-payments' ) );
        }
        $history = $order->get_meta( self::META_HISTORY, true );
        $history = is_array( $history ) ? $history : array();
        $history[] = array(
            'decision' => $decision,
            'user_id'  => get_current_user_id(),
            'date'     => current_time( 'mysql' ),
            'note'     => $note,
        );
        $order->update_meta_data( self::META_HISTORY, $history );
        $order->update_meta_data( self::META_STATUS, $decision );
        $order->update_meta_data( self::META_NOTE, $note );

        if ( 'approved' === $decision ) {
            $order->update_status( 'processing', __( 'Pago Yape verificado manualmente por el administrador.', 'edroz-qr-payments' ) );
        } else {
            // translators: %s is the administrator's reason for rejecting the Yape payment.
            $reason = $note ? sprintf( __( 'Pago Yape rechazado. Motivo: %s', 'edroz-qr-payments' ), $note ) : __( 'Pago Yape rechazado manualmente. Revisar con el cliente.', 'edroz-qr-payments' );
            $order->update_status( 'failed', $reason );
        }
        // translators: 1: review decision (approved or rejected), 2: administrator name, 3: optional review note.
        $order->add_order_note( sprintf( __( 'Verificación Edroz: %1$s por %2$s. %3$s', 'edroz-qr-payments' ), $decision, wp_get_current_user()->display_name, $note ) );
        $order->save();

        $redirect = add_query_arg(
            array( 'page' => self::MENU_SLUG, 'reviewed' => $decision, 'eyr_notice_nonce' => wp_create_nonce( 'eyr_review_notice' ) ),
            admin_url( 'admin.php' )
        );
        wp_safe_redirect( $redirect );
        exit;
    }

    public static function handle_bulk_review() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) { wp_die( esc_html__( 'No tienes permisos.', 'edroz-qr-payments' ) ); }
        check_admin_referer( 'edroz_yape_bulk_review' );
        $ids = isset( $_POST['order_ids'] ) ? array_slice( array_unique( array_map( 'absint', (array) wp_unslash( $_POST['order_ids'] ) ) ), 0, 100 ) : array();
        $decision = isset( $_POST['bulk_decision'] ) ? sanitize_key( wp_unslash( $_POST['bulk_decision'] ) ) : '';
        if ( ! $ids || ! in_array( $decision, array( 'approved', 'rejected' ), true ) ) {
            wp_safe_redirect( add_query_arg( array( 'page' => self::MENU_SLUG, 'bulk_result' => 'none', 'eyr_notice_nonce' => wp_create_nonce( 'eyr_review_notice' ) ), admin_url( 'admin.php' ) ) ); exit;
        }
        $done = 0;
        $bulk_allowed = class_exists( 'Edroz_QR_Usage' ) && Edroz_QR_Usage::is_pro() ? count( $ids ) : ( class_exists( 'Edroz_QR_Usage' ) ? Edroz_QR_Usage::remaining( 'bulk' ) : 0 );
        foreach ( $ids as $id ) {
            if ( $done >= $bulk_allowed ) { break; }
            $order = wc_get_order( $id );
            if ( ! $order || 'yapepay' !== $order->get_payment_method() || in_array( $order->get_meta( self::META_STATUS, true ), array( 'approved', 'rejected' ), true ) || ! $order->has_status( array( 'pending', 'on-hold', 'failed' ) ) ) { continue; }
            $history = $order->get_meta( self::META_HISTORY, true );
            $history = is_array( $history ) ? $history : array();
            $history[] = array( 'decision' => $decision, 'user_id' => get_current_user_id(), 'date' => current_time( 'mysql' ), 'note' => __( 'Acción masiva desde Verificación de pagos.', 'edroz-qr-payments' ) );
            $order->update_meta_data( self::META_HISTORY, $history );
            $order->update_meta_data( self::META_STATUS, $decision );
            if ( 'approved' === $decision ) {
                $order->update_status( 'processing', __( 'Pago Yape verificado manualmente mediante acción masiva.', 'edroz-qr-payments' ) );
            } else {
                $order->update_status( 'failed', __( 'Pago Yape rechazado mediante acción masiva. Revisar con el cliente.', 'edroz-qr-payments' ) );
            }
            // translators: 1: review decision (approved or rejected), 2: administrator name.
            $order->add_order_note( sprintf( __( 'Verificación Edroz masiva: %1$s por %2$s.', 'edroz-qr-payments' ), $decision, wp_get_current_user()->display_name ) );
            $order->save();
            if ( class_exists( 'Edroz_QR_Usage' ) && ! Edroz_QR_Usage::is_pro() ) { Edroz_QR_Usage::consume( 'bulk', 1, 'order-' . $id . '-' . $decision ); }
            ++$done;
        }
        wp_safe_redirect( add_query_arg( array( 'page' => self::MENU_SLUG, 'bulk_result' => $done, 'eyr_notice_nonce' => wp_create_nonce( 'eyr_review_notice' ) ), admin_url( 'admin.php' ) ) ); exit;
    }

    private static function get_orders() {
        return wc_get_orders( array(
            'limit'          => 500,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'payment_method' => 'yapepay',
            'return'         => 'objects',
            'status'         => array_keys( wc_get_order_statuses() ),
        ) );
    }

    private static function filters() {
        if ( isset( $_GET['eyr_status'] ) || isset( $_GET['eyr_period'] ) || isset( $_GET['eyr_search'] ) ) {
            check_admin_referer( 'eyr_filters', 'eyr_filters_nonce' );
        }
        $status = isset( $_GET['eyr_status'] ) ? sanitize_key( wp_unslash( $_GET['eyr_status'] ) ) : '';
        $period = isset( $_GET['eyr_period'] ) ? sanitize_key( wp_unslash( $_GET['eyr_period'] ) ) : '';
        $search = isset( $_GET['eyr_search'] ) ? sanitize_text_field( wp_unslash( $_GET['eyr_search'] ) ) : '';
        return array(
            'status' => in_array( $status, array( 'pending', 'approved', 'rejected' ), true ) ? $status : '',
            'period' => in_array( $period, array( 'today', '7days', 'month' ), true ) ? $period : '',
            'search' => $search,
        );
    }

    private static function matches( $order, $filters ) {
        $review = $order->get_meta( self::META_STATUS, true );
        $status = in_array( $review, array( 'approved', 'rejected' ), true ) ? $review : 'pending';
        if ( $filters['status'] && $status !== $filters['status'] ) { return false; }
        $date = $order->get_date_created();
        if ( $filters['period'] && $date ) {
            $timestamp = $date->getTimestamp();
            $now = current_datetime();
            if ( 'today' === $filters['period'] && wp_date( 'Y-m-d', $timestamp ) !== $now->format( 'Y-m-d' ) ) { return false; }
            if ( '7days' === $filters['period'] && $timestamp < strtotime( '-7 days', $now->getTimestamp() ) ) { return false; }
            if ( 'month' === $filters['period'] && wp_date( 'Y-m', $timestamp ) !== $now->format( 'Y-m' ) ) { return false; }
        }
        if ( $filters['search'] ) {
            $haystack = implode( ' ', array( $order->get_order_number(), $order->get_billing_first_name(), $order->get_billing_last_name(), $order->get_billing_email(), $order->get_meta( '_yape_plin_operation', true ) ) );
            if ( false === mb_stripos( $haystack, $filters['search'] ) ) { return false; }
        }
        return true;
    }

    public static function export_csv() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) { wp_die( 'Forbidden', '', array( 'response' => 403 ) ); }
        check_admin_referer( 'edroz_yape_export' );
        $filters = self::filters();
        nocache_headers();
        header( 'Content-Type: text/csv; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename="edroz-yape-operaciones-' . gmdate( 'Y-m-d' ) . '.csv"' );
        $out = fopen( 'php://output', 'w' );
        echo "\xEF\xBB\xBF";
        fputcsv( $out, array( 'Pedido', 'Cliente', 'Email', 'Monto', 'Moneda', 'Operacion', 'Estado', 'Fecha', 'Revisado por', 'Fecha revision', 'Motivo' ) );
        foreach ( self::get_orders() as $order ) {
            if ( ! self::matches( $order, $filters ) ) { continue; }
            $history = $order->get_meta( self::META_HISTORY, true );
            $last = is_array( $history ) && $history ? end( $history ) : array();
            $user = ! empty( $last['user_id'] ) ? get_userdata( (int) $last['user_id'] ) : false;
            $values = array( $order->get_order_number(), $order->get_formatted_billing_full_name(), $order->get_billing_email(), $order->get_total(), $order->get_currency(), $order->get_meta( '_yape_plin_operation', true ), $order->get_meta( self::META_STATUS, true ) ?: 'pending', $order->get_date_created() ? $order->get_date_created()->date( 'Y-m-d H:i:s' ) : '', $user ? $user->display_name : '', $last['date'] ?? '', $last['note'] ?? '' );
            // Prevent spreadsheet formula injection from user-provided fields.
            $values = array_map( static function( $value ) { $value = (string) $value; return preg_match( '/^[\s]*[=+@\-]/u', $value ) ? "'" . $value : $value; }, $values );
            fputcsv( $out, $values );
        }
        exit;
    }

    public static function render_page() {
        if ( ! current_user_can( 'manage_woocommerce' ) ) {
            wp_die( esc_html__( 'No tienes permisos para acceder a esta página.', 'edroz-qr-payments' ) );
        }

        $orders   = self::get_orders();
        $filters  = self::filters();
        $visible_orders = array_values( array_filter( $orders, static function( $order ) use ( $filters ) { return self::matches( $order, $filters ); } ) );
        $pending  = 0;
        $approved = 0;
        $rejected = 0;
        $total    = 0;
        $approved_7d = 0;
        $approved_month = 0;
        $now_ts = current_datetime()->getTimestamp();
        foreach ( $orders as $order ) {
            $review = $order->get_meta( self::META_STATUS, true );
            if ( 'approved' === $review ) {
                ++$approved;
                $total += (float) $order->get_total();
                $history_for_stats = $order->get_meta( self::META_HISTORY, true );
                $last_review = is_array( $history_for_stats ) && $history_for_stats ? end( $history_for_stats ) : array();
                $review_ts = ! empty( $last_review['date'] ) ? strtotime( $last_review['date'] ) : 0;
                if ( $review_ts ) {
                    if ( $review_ts >= ( $now_ts - 7 * DAY_IN_SECONDS ) ) { ++$approved_7d; }
                    if ( wp_date( 'Y-m', $review_ts ) === current_datetime()->format( 'Y-m' ) ) { ++$approved_month; }
                }
            } elseif ( 'rejected' === $review ) {
                ++$rejected;
            } else {
                ++$pending;
            }
        }
        $reviewed = isset( $_GET['reviewed'] ) ? sanitize_key( wp_unslash( $_GET['reviewed'] ) ) : '';
        if ( isset( $_GET['eyr_filters_nonce'] ) ) {
            check_admin_referer( 'eyr_filters', 'eyr_filters_nonce' );
        }
        if ( isset( $_GET['eyr_notice_nonce'] ) ) {
            check_admin_referer( 'eyr_review_notice', 'eyr_notice_nonce' );
        }
        ?>
        <div class="wrap edroz-admin-wrap edroz-yape-reviews">
            <section class="eyr-hero">
                <div class="eyr-brand"><span class="eyr-mark">Y</span><div><span>EDROZ QR PAYMENTS</span><h1><?php esc_html_e( 'Verificación de pagos', 'edroz-qr-payments' ); ?></h1><p><?php esc_html_e( 'Revisa las operaciones Yape y confirma los abonos recibidos en tu cuenta.', 'edroz-qr-payments' ); ?></p></div></div>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=edroz-qr-payments' ) ); ?>" class="eyr-back"><?php esc_html_e( 'Volver al panel', 'edroz-qr-payments' ); ?> →</a>
            </section>

            <?php if ( 'approved' === $reviewed || 'rejected' === $reviewed ) : ?>
                <div class="notice notice-success is-dismissible"><p><?php echo 'approved' === $reviewed ? esc_html__( 'Pago aprobado y pedido enviado a Procesando.', 'edroz-qr-payments' ) : esc_html__( 'Pago rechazado y pedido marcado como Fallido.', 'edroz-qr-payments' ); ?></p></div>
            <?php endif; ?>
            <?php if ( isset( $_GET['bulk_result'] ) ) : ?>
                <div class="notice notice-success is-dismissible"><p><?php
                    // translators: %s is the number of orders updated by the bulk action.
                    echo esc_html( sprintf( __( 'Acción masiva aplicada a %s pedidos válidos.', 'edroz-qr-payments' ), absint( $_GET['bulk_result'] ) ) );
                ?></p></div>
            <?php endif; ?>

            <?php if ( class_exists( 'Edroz_QR_Usage' ) && ! Edroz_QR_Usage::is_pro() ) : ?>
                <div class="eyr-free-usage" style="margin:16px 0;padding:14px 18px;background:#fff;border:1px solid #e7e2f2;border-radius:10px;display:flex;gap:22px;flex-wrap:wrap;align-items:center;">
                    <strong>Pruebas gratuitas FREE</strong>
                    <span>Descuentos: <?php echo esc_html( Edroz_QR_Usage::used( 'discount' ) . '/50' ); ?></span>
                    <span>Temporizador: <?php echo esc_html( Edroz_QR_Usage::used( 'timer' ) . '/50' ); ?></span>
                    <span>WhatsApp: <?php echo esc_html( Edroz_QR_Usage::used( 'whatsapp' ) . '/50' ); ?></span>
                    <span>Acciones masivas: <?php echo esc_html( Edroz_QR_Usage::used( 'bulk' ) . '/20' ); ?></span>
                    <span>Estadísticas avanzadas: <?php echo esc_html( Edroz_QR_Usage::stats_days_left() . '/30 días' ); ?></span>
                </div>
            <?php endif; ?>

            <div class="eyr-stats">
                <article><span class="eyr-stat-icon pending">◷</span><div><strong><?php echo esc_html( number_format_i18n( $pending ) ); ?></strong><small><?php esc_html_e( 'PENDIENTES', 'edroz-qr-payments' ); ?></small></div></article>
                <article><span class="eyr-stat-icon approved">✓</span><div><strong><?php echo esc_html( number_format_i18n( $approved ) ); ?></strong><small><?php esc_html_e( 'APROBADOS', 'edroz-qr-payments' ); ?></small></div></article>
                <article><span class="eyr-stat-icon rejected">×</span><div><strong><?php echo esc_html( number_format_i18n( $rejected ) ); ?></strong><small><?php esc_html_e( 'RECHAZADOS', 'edroz-qr-payments' ); ?></small></div></article>
                <article><span class="eyr-stat-icon total">S/</span><div><strong><?php echo wp_kses_post( wc_price( $total ) ); ?></strong><small><?php esc_html_e( 'TOTAL APROBADO', 'edroz-qr-payments' ); ?></small></div></article>
                <?php if ( ! class_exists( 'Edroz_QR_Usage' ) || Edroz_QR_Usage::stats_available() ) : ?>
                <article><span class="eyr-stat-icon approved">7d</span><div><strong><?php echo esc_html( number_format_i18n( $approved_7d ) ); ?></strong><small><?php esc_html_e( 'APROBADOS · 7 DÍAS', 'edroz-qr-payments' ); ?></small></div></article>
                <article><span class="eyr-stat-icon total">M</span><div><strong><?php echo esc_html( number_format_i18n( $approved_month ) ); ?></strong><small><?php esc_html_e( 'APROBADOS · ESTE MES', 'edroz-qr-payments' ); ?></small></div></article>
                <?php else : ?><article class="eyr-pro-locked"><div><strong>Estadísticas avanzadas · PRO</strong><small>Prueba gratuita finalizada. Consulta Edroz PRO.</small></div></article><?php endif; ?>
            </div>

            <form class="eyr-filters" method="get" action="<?php echo esc_url( admin_url( 'admin.php' ) ); ?>">
                <?php wp_nonce_field( 'eyr_filters', 'eyr_filters_nonce' ); ?>
                <input type="hidden" name="page" value="<?php echo esc_attr( self::MENU_SLUG ); ?>">
                <input type="search" name="eyr_search" value="<?php echo esc_attr( $filters['search'] ); ?>" placeholder="Buscar pedido, cliente u operación">
                <select name="eyr_status"><option value="">Todos los estados</option><?php foreach ( array( 'pending' => 'Pendientes', 'approved' => 'Aprobados', 'rejected' => 'Rechazados' ) as $value => $label ) : ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $filters['status'], $value ); ?>><?php echo esc_html( $label ); ?></option><?php endforeach; ?></select>
                <select name="eyr_period"><option value="">Todas las fechas</option><?php foreach ( array( 'today' => 'Hoy', '7days' => 'Últimos 7 días', 'month' => 'Este mes' ) as $value => $label ) : ?><option value="<?php echo esc_attr( $value ); ?>" <?php selected( $filters['period'], $value ); ?>><?php echo esc_html( $label ); ?></option><?php endforeach; ?></select>
                <button type="submit" class="button button-primary">Filtrar</button>
                <a class="button" href="<?php echo esc_url( admin_url( 'admin.php?page=' . self::MENU_SLUG ) ); ?>">Limpiar</a>
                <?php $export_url = wp_nonce_url( add_query_arg( array( 'action' => 'edroz_yape_export', 'eyr_search' => $filters['search'], 'eyr_status' => $filters['status'], 'eyr_period' => $filters['period'], 'eyr_filters_nonce' => wp_create_nonce( 'eyr_filters' ) ), admin_url( 'admin-post.php' ) ), 'edroz_yape_export' ); ?>
                <a class="button eyr-export" href="<?php echo esc_url( $export_url ); ?>">Exportar CSV</a>
            </form>
            <form class="eyr-bulk-toolbar" id="eyr-bulk-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="edroz_yape_bulk_review">
                <?php wp_nonce_field( 'edroz_yape_bulk_review' ); ?>
                <strong><?php esc_html_e( 'Acciones masivas:', 'edroz-qr-payments' ); ?></strong>
                <select name="bulk_decision"><option value=""><?php esc_html_e( 'Selecciona acción', 'edroz-qr-payments' ); ?></option><option value="approved"><?php esc_html_e( 'Aprobar seleccionados', 'edroz-qr-payments' ); ?></option><option value="rejected"><?php esc_html_e( 'Rechazar seleccionados', 'edroz-qr-payments' ); ?></option></select>
                <span id="eyr-selected-count">0 seleccionados</span>
                <button type="submit" class="button" onclick="return confirm('Verifica los abonos directamente en Yape antes de aprobar. ¿Continuar?');"><?php esc_html_e( 'Aplicar', 'edroz-qr-payments' ); ?></button>
            </form>
            <section class="eyr-table-card">
                <div class="eyr-table-heading"><div><h2><?php esc_html_e( 'Operaciones Yape', 'edroz-qr-payments' ); ?></h2><p><?php esc_html_e( 'Últimos 500 pedidos recibidos mediante Yape.', 'edroz-qr-payments' ); ?></p></div>
                <?php
                // translators: %s is the number of Yape orders displayed in the table.
                $orders_count_label = sprintf( _n( '%s pedido', '%s pedidos', count( $visible_orders ), 'edroz-qr-payments' ), number_format_i18n( count( $visible_orders ) ) );
                ?>
                <span><?php echo esc_html( $orders_count_label ); ?></span></div>
                <div class="eyr-table-scroll"><table class="widefat fixed striped eyr-orders"><thead><tr><th class="eyr-check-col"><input type="checkbox" id="eyr-select-all" aria-label="Seleccionar todos"></th><th><?php esc_html_e( 'Pedido', 'edroz-qr-payments' ); ?></th><th><?php esc_html_e( 'Cliente', 'edroz-qr-payments' ); ?></th><th><?php esc_html_e( 'Monto', 'edroz-qr-payments' ); ?></th><th><?php esc_html_e( 'N.º operación', 'edroz-qr-payments' ); ?></th><th><?php esc_html_e( 'Estado', 'edroz-qr-payments' ); ?></th><th><?php esc_html_e( 'Fecha', 'edroz-qr-payments' ); ?></th><th><?php esc_html_e( 'Acciones', 'edroz-qr-payments' ); ?></th></tr></thead><tbody>
                <?php if ( empty( $visible_orders ) ) : ?>
                    <tr><td colspan="8" class="eyr-empty"><?php esc_html_e( 'Todavía no hay pedidos registrados con Yape.', 'edroz-qr-payments' ); ?></td></tr>
                <?php else : foreach ( $visible_orders as $order ) :
                    $review = $order->get_meta( self::META_STATUS, true );
                    $operation = $order->get_meta( '_yape_plin_operation', true );
                    $name = trim( $order->get_formatted_billing_full_name() );
                    if ( ! $name ) { $name = __( 'Cliente', 'edroz-qr-payments' ); }
                    $date = $order->get_date_created();
                    $history = $order->get_meta( self::META_HISTORY, true );
                    $last = is_array( $history ) && $history ? end( $history ) : array();
                    $review_user = ! empty( $last['user_id'] ) ? get_userdata( (int) $last['user_id'] ) : false;
                    $badge = 'approved' === $review ? 'approved' : ( 'rejected' === $review ? 'rejected' : 'pending' );
                    $label = 'approved' === $review ? __( 'Aprobado', 'edroz-qr-payments' ) : ( 'rejected' === $review ? __( 'Rechazado', 'edroz-qr-payments' ) : __( 'Pendiente', 'edroz-qr-payments' ) );
                    // translators: %s is the WooCommerce order number.
                    $select_order_label = sprintf( __( 'Seleccionar pedido %s', 'edroz-qr-payments' ), $order->get_order_number() );
                    ?>
                    <tr>
                        <td class="eyr-check-col"><?php if ( 'approved' !== $review && 'rejected' !== $review && $order->has_status( array( 'pending', 'on-hold', 'failed' ) ) ) : ?><input type="checkbox" class="eyr-row-check" value="<?php echo esc_attr( $order->get_id() ); ?>" aria-label="<?php echo esc_attr( $select_order_label ); ?>" ><?php endif; ?></td>
                        <td><a class="eyr-order-link" href="<?php echo esc_url( $order->get_edit_order_url() ); ?>">#<?php echo esc_html( $order->get_order_number() ); ?></a></td>
                        <td><strong><?php echo esc_html( $name ); ?></strong><small><?php echo esc_html( $order->get_billing_email() ); ?></small><?php if ( 'pending' === $badge && $order->has_status( array( 'pending', 'on-hold', 'failed' ) ) ) : $phone = preg_replace( '/[^0-9]/', '', $order->get_billing_phone() ); if ( 9 === strlen( $phone ) ) { $phone = '51' . $phone; } if ( $phone && ( ! class_exists( 'Edroz_QR_Usage' ) || Edroz_QR_Usage::can_use( 'whatsapp' ) ) ) : // translators: 1: customer name, 2: WooCommerce order number, 3: formatted order total.
$wa_text = sprintf( __( 'Hola %1$s, te contactamos por tu pedido #%2$s de %3$s. Si ya realizaste el pago con Yape, por favor envíanos la confirmación para verificarlo. Gracias.', 'edroz-qr-payments' ), $name, $order->get_order_number(), trim( html_entity_decode( wp_strip_all_tags( $order->get_formatted_order_total() ), ENT_QUOTES | ENT_HTML5, get_bloginfo( 'charset' ) ) ) ); ?><a class="eyr-whatsapp" target="_blank" rel="noopener noreferrer" href="<?php echo esc_url( class_exists( 'Edroz_QR_Usage' ) ? Edroz_QR_Usage::whatsapp_url( $order->get_id(), $phone, $wa_text ) : ( 'https://wa.me/' . $phone . '?text=' . rawurlencode( $wa_text ) ) ); ?>">WhatsApp</a><?php endif; endif; ?></td>
                        <td><strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong></td>
                        <td><?php echo $operation ? '<code>' . esc_html( $operation ) . '</code>' : '<span class="eyr-muted">—</span>'; ?></td>
                        <td><span class="eyr-badge is-<?php echo esc_attr( $badge ); ?>"><?php echo esc_html( $label ); ?></span><?php if ( $last ) : ?><small title="<?php echo esc_attr( $last['note'] ?? '' ); ?>"><?php echo esc_html( ( $review_user ? $review_user->display_name : 'Usuario' ) . ' · ' . ( $last['date'] ?? '' ) ); ?></small><?php if ( ! empty( $last['note'] ) ) : ?><small><?php echo esc_html( $last['note'] ); ?></small><?php endif; ?><?php endif; ?></td>
                        <td><?php echo $date ? esc_html( wc_format_datetime( $date ) ) : '—'; ?></td>
                        <td class="eyr-actions">
                            <?php if ( 'approved' !== $review && 'rejected' !== $review && $order->has_status( array( 'pending', 'on-hold', 'failed' ) ) ) : ?>
                                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="eyr-review-form">
                                    <input type="hidden" name="action" value="edroz_yape_review"><input type="hidden" name="order_id" value="<?php echo esc_attr( $order->get_id() ); ?>"><input type="hidden" name="decision" value="approved"><?php wp_nonce_field( 'edroz_yape_review_order' ); ?>
                                    <button class="button button-primary eyr-approve" type="submit" onclick="return confirm('<?php echo esc_js( __( 'Confirma que verificaste el abono directamente en Yape y deseas aprobar este pedido.', 'edroz-qr-payments' ) ); ?>');"><?php esc_html_e( 'Aprobar', 'edroz-qr-payments' ); ?></button>
                                </form>
                                <details class="eyr-reject"><summary><?php esc_html_e( 'Rechazar', 'edroz-qr-payments' ); ?></summary><form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"><input type="hidden" name="action" value="edroz_yape_review"><input type="hidden" name="order_id" value="<?php echo esc_attr( $order->get_id() ); ?>"><input type="hidden" name="decision" value="rejected"><?php wp_nonce_field( 'edroz_yape_review_order' ); ?><input type="text" name="review_note" placeholder="<?php esc_attr_e( 'Motivo (opcional)', 'edroz-qr-payments' ); ?>"><button class="button" type="submit" onclick="return confirm('<?php echo esc_js( __( '¿Rechazar este pago y marcar el pedido como fallido?', 'edroz-qr-payments' ) ); ?>');"><?php esc_html_e( 'Confirmar', 'edroz-qr-payments' ); ?></button></form></details>
                            <?php else : ?><a class="button" href="<?php echo esc_url( $order->get_edit_order_url() ); ?>"><?php esc_html_e( 'Ver pedido', 'edroz-qr-payments' ); ?></a><?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody></table></div>
                <p class="eyr-disclaimer"><strong><?php esc_html_e( 'Importante:', 'edroz-qr-payments' ); ?></strong> <?php esc_html_e( 'El número de operación lo escribe el cliente y no confirma por sí solo que el dinero haya llegado. Verifica el abono en tu aplicación Yape antes de aprobar.', 'edroz-qr-payments' ); ?></p>
            </section>
            <script>
            (function(){var form=document.getElementById('eyr-bulk-form');if(!form)return;var checks=[].slice.call(document.querySelectorAll('.eyr-row-check'));var all=document.getElementById('eyr-select-all');var count=document.getElementById('eyr-selected-count');function sync(){var selected=checks.filter(function(c){return c.checked;});count.textContent=selected.length+' seleccionados';form.querySelectorAll('input[name="order_ids[]"]').forEach(function(n){n.remove();});selected.forEach(function(c){var input=document.createElement('input');input.type='hidden';input.name='order_ids[]';input.value=c.value;form.appendChild(input);});}checks.forEach(function(c){c.addEventListener('change',sync);});if(all){all.addEventListener('change',function(){checks.forEach(function(c){c.checked=all.checked;});sync();});}form.addEventListener('submit',function(e){sync();if(!form.querySelector('input[name="order_ids[]"]')||!form.querySelector('[name="bulk_decision"]').value){e.preventDefault();alert('Selecciona pedidos y una acción.');}});})();
            </script>
        </div>
        <?php
    }
}
