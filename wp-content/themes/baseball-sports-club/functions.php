<?php
/**
 * baseball-sports-club functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package baseball-sports-club
 */

if ( ! defined( 'BASEBALL_SPORTS_CLUB_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'BASEBALL_SPORTS_CLUB_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function baseball_sports_club_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on baseball-sports-club, use a find and replace
		* to change 'baseball-sports-club' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'baseball-sports-club', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/**
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
	add_theme_support('post-thumbnails');


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'baseball-sports-club' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'baseball_sports_club_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'baseball_sports_club_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $baseball_sports_club_content_width_global
 */
function baseball_sports_club_content_width() {
	$GLOBALS['baseball_sports_club_content_width_global'] = apply_filters( 'baseball_sports_club_content_width', 640 );
}
add_action( 'after_setup_theme', 'baseball_sports_club_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function baseball_sports_club_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'baseball-sports-club' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'baseball-sports-club' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'baseball_sports_club_widgets_init' );

/**
 * Register custom fonts.
 */
function baseball_sports_club_fonts_url()
{
	$fonts_url = '';
	$fonts = array();
	$subsets = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Lora, translate this to 'off'. Do not translate into your own language. */
	if ('off' !== _x('on', 'Lora: on or off', 'baseball-sports-club')) {
		$fonts[] = 'Lora:400,600,700';
	}

	if ('off' !== _x('on', 'Space Grotesk: on or off', 'baseball-sports-club')) {
		$fonts[] = 'Space Grotesk:300,400,500,600,700';
	}

	if ($fonts) {
		$fonts_url = add_query_arg(
			array(
				'family' => urlencode(implode('|', $fonts)),
				'subset' => urlencode($subsets),
			), 'https://fonts.googleapis.com/css');
	}

	return esc_url_raw($fonts_url);
}

/**
 * Function that returns if the menu is sticky
 */
if (!function_exists('baseball_sports_club_sticky_header')):
    function baseball_sports_club_sticky_header()
    {
        $is_sticky = get_theme_mod('baseball_sports_club_sticky_header', false);

        if ($is_sticky == false):
            return 'not-sticky';
        else:
            return 'is-sticky-on';
        endif;
    }
endif;

/**
 * Enqueue scripts and styles.
 */
function baseball_sports_club_scripts() {
	wp_enqueue_style( 'baseball-sports-club-style', get_stylesheet_uri(), array(), BASEBALL_SPORTS_CLUB_S_VERSION );
	wp_style_add_data( 'baseball-sports-club-style', 'rtl', 'replace' );

	wp_enqueue_style('all.css', get_stylesheet_directory_uri() . "/assets/css/all.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('baseball-sports-club-responsive.css', get_stylesheet_directory_uri() . "/assets/css/responsive.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('all.min.css', get_stylesheet_directory_uri() . "/assets/css/all.min.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('animate-3.5.2.css', get_stylesheet_directory_uri() . "/assets/css/animate-3.5.2.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('animate.css', get_stylesheet_directory_uri() . "/assets/css/animate.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('baseball-sports-club-output.css', get_stylesheet_directory_uri() . "/assets/css/output.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('baseball-sports-club-blocks.css', get_stylesheet_directory_uri() . "/assets/css/blocks.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('baseball-sports-club-blocks.min.css', get_stylesheet_directory_uri() . "/assets/css/blocks.min.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('bootstrap.min.css', get_stylesheet_directory_uri() . "/assets/css/bootstrap.min.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('slick-theme.css', get_stylesheet_directory_uri() . "/assets/css/slick-theme.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('slick-theme.min.css', get_stylesheet_directory_uri() . "/assets/css/slick-theme.min.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('slick.css', get_stylesheet_directory_uri() . "/assets/css/slick.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('slick.min.css', get_stylesheet_directory_uri() . "/assets/css/slick.min.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('baseball-sports-club-pe-customize-controls.css', get_stylesheet_directory_uri() . "/assets/css/pe-customize-controls.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	wp_enqueue_style('swiper-bundle.min.css', get_stylesheet_directory_uri() . "/assets/css/swiper-bundle.min.css", '', BASEBALL_SPORTS_CLUB_S_VERSION);
	

	wp_enqueue_script( 'baseball-sports-club-navigation', get_template_directory_uri() . '/js/navigation.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'all.min.js', get_template_directory_uri() . '/assets/js/all.min.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );	
	wp_enqueue_script( 'jquery.min.js', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );	
	wp_enqueue_script( 'custom.js', get_template_directory_uri() . '/assets/js/custom.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'bootstrap.bundle.min.js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'baseball-sports-club-custom.js', get_template_directory_uri() . '/assets/js/custom.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'jquery.counterup.min.js', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'slick.js', get_template_directory_uri() . '/assets/js/slick.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'slick.min.js', get_template_directory_uri() . '/assets/js/slick.min.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'swiper-bundle.min.js', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'slider-control.js', get_template_directory_uri() . '/assets/js/slider-control.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	wp_enqueue_script( 'circletype.min.js', get_template_directory_uri() . '/assets/js/circletype.min.js', array(), BASEBALL_SPORTS_CLUB_S_VERSION, true );
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'baseball_sports_club_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Custom functions that act independently of the theme templates.
 */
// require get_template_directory() . '/inc/extras.php';
if ( ! function_exists( 'baseball_sports_club_the_excerpt' ) ) :

	function baseball_sports_club_the_excerpt( $length = 0, $post_obj = null ) {

		global $post;

		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );

		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_obj->post_content;

		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );
		return $trimmed_content;

	}

endif;
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
// Integer sanitization
if ( ! function_exists( 'baseball_sports_club_sanitize_integer' ) ) {
    function baseball_sports_club_sanitize_integer( $input ) {
        return (int) $input;
    }
}
function baseball_sports_club_customizer_script() {
    wp_enqueue_script(
        'baseball_sports_club-customizer-script',
        get_template_directory_uri() . '/assets/js/customizer-button.js',
        ['customize-controls'],
        '1.0',
        true
    );
}
add_action( 'customize_controls_enqueue_scripts', 'baseball_sports_club_customizer_script' );




