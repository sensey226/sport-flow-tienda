<?php
/**
 * Theme Info Page
 *
 * @package Sports Association
 */

function sports_association_theme_details() {
	add_theme_page( 'Themes', 'Sports Association Theme', 'edit_theme_options', 'sports-association-theme-info-page', 'theme_details_display', null );
}
add_action( 'admin_menu', 'sports_association_theme_details' );

function theme_details_display() {

	include_once 'templates/theme-details.php';

}

add_action( 'admin_enqueue_scripts', 'sports_association_theme_details_style' );

function sports_association_theme_details_style() {
    wp_register_style( 'sports_association_theme_details_css', get_template_directory_uri() . '/inc/sports-association-theme-info-page/css/theme-details.css', false, '1.0.0' );
    wp_enqueue_style( 'sports_association_theme_details_css' );

    wp_register_script( 'sports_association_copy_coupon_js', get_template_directory_uri() . '/inc/sports-association-theme-info-page/js/sports-association-copy-coupon.js', array(), '1.0.0', true );
    wp_enqueue_script( 'sports_association_copy_coupon_js' );
}