<?php
/**
 * baseball-sports-club Theme Customizer
 *
 * @package baseball-sports-club
 */

 // Custom Controls.
require get_template_directory() . '/inc/custom-control/custom-control.php';

// Sanitize callback.
require get_template_directory() . '/inc/customizer/sanitize-callback.php';

// Default
require get_template_directory() . '/inc/customizer/default.php';

// Load customize sanitize.
include get_template_directory() . '/inc/customizer/active-callback.php';


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function baseball_sports_club_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'baseball_sports_club_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'baseball_sports_club_customize_partial_blogdescription',
			)
		);
	}
	// Front Page Link
	require get_template_directory() . '/inc/customizer/home-section.php';

	require get_template_directory() . '/inc/customizer/section-pro.php';

	// Theme Page Link
	require get_template_directory() . '/inc/customizer/theme-options.php';
}
add_action( 'customize_register', 'baseball_sports_club_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function baseball_sports_club_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function baseball_sports_club_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function baseball_sports_club_customize_preview_js() {
	wp_enqueue_script( 'baseball_sports_club-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), BASEBALL_SPORTS_CLUB_S_VERSION, true );
}
add_action( 'customize_preview_init', 'baseball_sports_club_customize_preview_js' );

/**
 *
 */
function baseball_sports_club_customize_backend_scripts() {

	wp_enqueue_style( 'baseball-sports-club-fontawesome-all', get_template_directory_uri() . '/assets/css/all.css' );

	wp_enqueue_style( 'baseball-sports-club-main-css', get_template_directory_uri() . '/assets/css/output.css' );

	wp_enqueue_style( 'baseball-sports-club-admin-customizer-style', get_template_directory_uri() . '/inc/customizer/css/customizer-style.css' );

	wp_enqueue_script( 'baseball-sports-club-admin-customizer', get_template_directory_uri() . '/inc/customizer/js/customizer-script.js', array( 'jquery', 'customize-controls' ), '20151215', true );
	wp_enqueue_script( 'baseball-sports-club-admin-customizer-control', get_template_directory_uri() . '/inc/customizer/js/customize-controls.js', array( 'jquery', 'customize-controls' ), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'baseball_sports_club_customize_backend_scripts', 10 );

/**
 * Enqueue the stylesheet.
 */
function baseball_sports_club_customizer_stylesheet() {

    wp_register_style( 'baseball-sports-club-admin-css', get_template_directory_uri() . '/inc/customizer/css/customize-controls.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'baseball-sports-club-admin-css' );
}
add_action( 'customize_controls_print_styles', 'baseball_sports_club_customizer_stylesheet' );

function baseball_sports_club_customize_css()
{
?>
	<style type="text/css">		
		/* ---------------## Theme Option Section Color Start ##------------- */
		.nav-container{
			background-color: <?php echo esc_html(get_theme_mod('Header_bg_color')); ?>;
		}
		.social-links p{
			color: <?php echo esc_html(get_theme_mod('Phone_color')); ?>;
		}
		.site-navigation .social-links, .socialicon{
			color: <?php echo esc_html(get_theme_mod('Phone_icon_color')); ?>;
		}
		.slider-inner-mainbox .slider-socialicon .socialicon{
			color: <?php echo esc_html(get_theme_mod('social_icon_color')); ?>;
		}
		#secondary .widget-title, .wp-block-search__label{
			color: <?php echo esc_html(get_theme_mod('Heading_text_color')); ?>;
		}
		.widget .widget-title::before, .widget .wp-block-heading::before{
			background-color: <?php echo esc_html(get_theme_mod('Search_background_color')); ?>;
		}
		#secondary ul li a, .sidebar-div .wp-block-archives-list li a, .sidebar-div .wp-block-categories-list li a, .sidebar-div .wp-block-latest-posts__list li a, .single_sidebar .wp-block-archives-list li a, .single_sidebar .wp-block-categories-list li a, .single_sidebar .wp-block-latest-posts__list li a, .widget_archive p, .widget_archive select, .widget_categories li a, .widget_recent_entries li a{
			color: <?php echo esc_html(get_theme_mod('Text_color')); ?>;
		}
		#site-navigation ul li a{
			color: <?php echo esc_html(get_theme_mod('menu_text_color')); ?>;
		}
		.wp-block-search__button{
			background-color: <?php echo esc_html(get_theme_mod('Search_button_bg_color')); ?>!important;
		}
		
		.wp-block-search__button{
			color: <?php echo esc_html(get_theme_mod('Search_button_text_color')); ?>!important;
		}

		.maincontent .page-title a{
			color: <?php echo esc_html(get_theme_mod('post_title_color')); ?>;
		}
		.maincontent .entry-meta .post-date svg {
			color: <?php echo esc_html(get_theme_mod('calender_icon_color')); ?>;
		}
		.maincontent .entry-meta .post-comment svg {
			color: <?php echo esc_html(get_theme_mod('comment_icon_color')); ?>;
		}
		.maincontent .entry-meta .post-date a{
			color: <?php echo esc_html(get_theme_mod('post_date_text_color')); ?>;
		}
		.maincontent .entry-meta .post-comment a{
			color: <?php echo esc_html(get_theme_mod('post_comment_text_color')); ?>;
		}
		.maincontent p{
			color: <?php echo esc_html(get_theme_mod('post_text_color')); ?>;
		}
		.maincontent .button-content{
			background-color: <?php echo esc_html(get_theme_mod('post_readmore_bg_color')); ?>;
		}

		.maincontent .readbtn{
			color: <?php echo esc_html(get_theme_mod('post_readmore_text_color')); ?>;
		}

		/* ---------------## Slider Section Color Start ##------------- */
		#featured-slider .entry-container h4{
			color: <?php echo esc_html(get_theme_mod('slider_title_color')); ?>;
		}

		#featured-slider .entry-container .content{
			color: <?php echo esc_html(get_theme_mod('slider_subtitle_color')); ?>;
		}

		#featured-slider .content a, #featured-slider code,
		.wp-block-buttons .wp-block-button__link, .singlepage #submit{
			background: <?php echo esc_html(get_theme_mod('slider_readmore_color')); ?>;
		}

		#featured-slider .content a, #featured-slider code,
		.wp-block-buttons .wp-block-button__link, .singlepage #submit{
			color: <?php echo esc_html(get_theme_mod('slider_readmoretxt_color')); ?>!important;
		}

		#featured-slider .slick-dots li{
			background: <?php echo esc_html(get_theme_mod('slider_slickdot_color')); ?>;
		}

		#featured-slider .slick-dots li.slick-active{
			background: <?php echo esc_html(get_theme_mod('slider_activeslickdot_color')); ?>;
		}

		#featured-slider .sliderbut1 a{
			color: <?php echo esc_html(get_theme_mod('GetTouchButton_color')); ?>;
		}
		#featured-slider .sliderbut1{
			background: <?php echo esc_html(get_theme_mod('GetTouchButton_bgcolor')); ?>;
		}
		#featured-slider .sliderbut2 a{
			color: <?php echo esc_html(get_theme_mod('slider_buttontext2_color')); ?>;
		}
		#featured-slider .sliderbut2{
			background: <?php echo esc_html(get_theme_mod('slider_buttonbg2_color')); ?>;
		}
		#featured-slider .sliderbut1:hover{
			background-color: <?php echo esc_html(get_theme_mod('GetTouchButton_hovercolor')); ?>;
		}
		/* ---------------## Slider Section Color End ##------------- */

		/* ------------------------------------Featured Section------------------------ */
		#featured-features .featuredicon svg{
			color: <?php echo esc_html(get_theme_mod('featured_icons_color')); ?>;
		}

		#featured-features h4.features-title a{
			color: <?php echo esc_html(get_theme_mod('featured_title_color')); ?>;
		}
		#featured-features .features-details p{
			color: <?php echo esc_html(get_theme_mod('featured_text_color')); ?>;
		}
/* ------------------------------------Featured Section End------------------------ */
		/* ---------------## About Section Color Start ##------------- */
		#featured-about .nav-tabs .nav-link.active{
			color: <?php echo esc_html(get_theme_mod('about_info_active_title_color')); ?>;
		}
		#featured-about .nav-tabs .nav-link{
			color: <?php echo esc_html(get_theme_mod('about_info_deactive_title_color')); ?>;
		}
		#featured-about .title-section .animatfirst-text{
			color: <?php echo esc_html(get_theme_mod('subheading_first_word_color')); ?>;
		}
		#featured-about .title-section .animatsecond-text .span1{
			color: <?php echo esc_html(get_theme_mod('subheading_second_word_color')); ?>;
		}
		/* ---------------## What we Offer Section Color End ##------------- */
	</style>
	
<?php
}
add_action('wp_head', 'baseball_sports_club_customize_css');
