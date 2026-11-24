<?php
/**
 * Sports Association functions and definitions
 *
 * @package Sports Association
 * @since 1.0
 */

if ( ! function_exists( 'sports_association_support' ) ) :
	function sports_association_support() {
		
		load_theme_textdomain( 'sports-association', get_template_directory() . '/languages' );

		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'sports_association_custom_background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
		
		add_theme_support( 'wp-block-styles' );

		add_editor_style( 'style.css' );

		define('SPORTS_ASSOCIATION_BUY_NOW',__('https://www.themescarts.com/products/sports-WordPress-theme/','sports-association'));
		define('SPORTS_ASSOCIATION_FOOTER_BUY_NOW',__('https://www.themescarts.com/products/sports-association/','sports-association'));
		define('SPORTS_ASSOCIATION_BUNDLE_LINK',__('https://www.themescarts.com/products/WordPress-theme-bundle/','sports-association'));

	}
endif;
add_action( 'after_setup_theme', 'sports_association_support' );

/*-------------------------------------------------------------
 Enqueue Styles
--------------------------------------------------------------*/

if ( ! function_exists( 'sports_association_styles' ) ) :
	function sports_association_styles() {
		// Register theme stylesheet.
		wp_enqueue_style('sports-association-style', get_stylesheet_uri(), array(), wp_get_theme()->get('version') );
		wp_enqueue_style('sports-association-style-blocks', get_template_directory_uri(). '/assets/css/blocks.css');
		wp_enqueue_style('sports-association-style-responsive', get_template_directory_uri(). '/assets/css/responsive.css');
		wp_style_add_data( 'sports-association-style', 'rtl', 'replace' );
		wp_enqueue_script( 'wow-js', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), true );
		wp_enqueue_script( 'sports-association-custom-js', get_theme_file_uri( '/assets/js/custom.js' ), array( 'jquery' ), true );
		
		wp_enqueue_style( 'animate-css', get_template_directory_uri().'/assets/css/animate.css' );

		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css', array(), wp_get_theme()->get('Version') );
	}
endif;
add_action( 'wp_enqueue_scripts', 'sports_association_styles' );

function sports_association_enqueue_admin_script($hook) {
    // Enqueue admin JS for notices
    wp_enqueue_script('sports-association-welcome-notice', get_template_directory_uri() . '/inc/sports-association-theme-info-page/js/sports-association-welcome-notice.js', array('jquery'), '', true);
    
    // Localize script to pass data to JavaScript
    wp_localize_script('sports-association-welcome-notice', 'sports_association_localize', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sports_association_welcome_nonce'),
        'dismiss_nonce' => wp_create_nonce('sports_association_welcome_nonce'), // Nonce for dismissal
        'redirect_url' => admin_url('themes.php?page=sports-association-theme-info-page')
    ));
}
add_action('admin_enqueue_scripts', 'sports_association_enqueue_admin_script');

if (!function_exists('sports_association_enable_plugin_autoupdate')) {

    add_filter('auto_update_plugin', function ($update, $item) {
        if ($item->slug === 'siteready-coming-soon-under-construction') {
            return true;
        }
        return $update;
    }, 10, 2);

}

function sports_association_plugin_update_available($slug, $file) {
    $updates = get_site_transient('update_plugins');

    if (!isset($updates->response[$slug . '/' . $file])) {
        return false; // No update available
    }

    return $updates->response[$slug . '/' . $file];
}

require get_template_directory() .'/inc/TGM/tgm.php';

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

require_once get_theme_file_path( 'inc/sports-association-theme-info-page/templates/class-theme-notice.php' );

require_once get_theme_file_path( 'inc/sports-association-theme-info-page/class-theme-info.php' );

require_once get_theme_file_path( '/inc/customizer.php' );	
?>