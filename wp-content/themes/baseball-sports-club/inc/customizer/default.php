<?php
/**
 * Default theme options.
 *
 * @package baseball-sports-club
 */

if ( ! function_exists( 'baseball_sports_club_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function baseball_sports_club_get_default_theme_options() {

	$baseball_sports_club_defaults = array();
	

    // Front Page Content
	$baseball_sports_club_defaults['enable_frontpage_content'] 		= true;

	// Slider Section	
	$baseball_sports_club_defaults['enable_featured_slider_section']		    	= true;
	$baseball_sports_club_defaults['featured_slider_content_type']		    	= 'featured_slider_page';
	$baseball_sports_club_defaults['featured_slider_category_readmore_text']		= esc_html__('Read More','baseball-sports-club');
	$baseball_sports_club_defaults['data_slick_speed']					    	= 1000;
	$baseball_sports_club_defaults['data_slick_infinite']				    	= 1;
	$baseball_sports_club_defaults['data_slick_dots']					    	= 1;
	$baseball_sports_club_defaults['data_slick_autoplay']				    	= 1;
	$baseball_sports_club_defaults['data_slick_draggable']				    	= 1;
	$baseball_sports_club_defaults['data_slick_fade']					    	= 1;
	$baseball_sports_club_defaults['number_of_featured_slider_items']	    	= 6;

	// Features Section
	$baseball_sports_club_defaults['enable_featured_features_section']			= true;
	$baseball_sports_club_defaults['number_of_featured_features_items']			= 6;
	$baseball_sports_club_defaults['featured_features_column']					= 3;
	$baseball_sports_club_defaults['featured_features_content_type']				= 'featured_features_page';
	$baseball_sports_club_defaults['feture_section_excerpt']						= 25;
	

	// About Section	
	$baseball_sports_club_defaults['enable_featured_about_section']				= true;
	$baseball_sports_club_defaults['about_image_show'] 							= true;
	$baseball_sports_club_defaults['featured_about_section_subword']	    		= esc_html__( 'WHERE', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_title1']	    		= esc_html__( 'CHAMPIONS ARE MADE,', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_title2']	    		= esc_html__( ' ONE PITCH AT A TIME.', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_number']	    		= esc_html__( '30', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_numtext']	    		= esc_html__( 'Years Of Experience', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_bxtitle1']	    	    = esc_html__( 'Expert Coaching', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_text1']	    	    = esc_html__( 'There are many variations of passages of injected humour randomised even slightly believable.', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_bxtitle2']	    	= esc_html__( 'Competitive Play', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_bxtitle3']	    	= esc_html__( 'Professional Coaching', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_bxtitle4']	    	= esc_html__( 'Sportsmanship', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_text2']	    	    = esc_html__( 'There are many variations of passages of injected humour randomised even slightly believable.', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_iconabout1']					    = esc_html__( 'fas fa-star', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_iconabout2']					    = esc_html__( 'fas fa-user-graduate', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_iconabout3']					    = esc_html__( 'fas fa-person', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_iconabout4']					    = esc_html__( 'fas fa-user', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_section_buttontext']	    	= esc_html__( 'Read More', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_iconbutnicn']	    				= esc_html__( 'fas fa-arrow-up', 'baseball-sports-club' );
	// ////
	$baseball_sports_club_defaults['featured_about_info_title1']	    				= esc_html__( 'Our History', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_info_text1']	    				= esc_html__( 'Sed posuere libero ac nisi maximus fermentum. Duis imperdiet venenatis leo sit amet congue. Suspendisse ullamcorper nisl quis augue dapibus mattis. Donec tincidunt, nulla volutpat placerat ultricies, orci nisi facilisis velit, id pretium arcu nibh mattis augue.', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_info_text2']	    				= esc_html__( 'Sed posuere libero ac nisi maximus fermentum. Duis imperdiet venenatis leo sit amet congue. Suspendisse ullamcorper nisl quis augue dapibus mattis. Donec tincidunt, nulla volutpat placerat ultricies, orci nisi facilisis velit, id pretium arcu nibh mattis augue.', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_info_text3']	    				= esc_html__( 'Sed posuere libero ac nisi maximus fermentum. Duis imperdiet venenatis leo sit amet congue. Suspendisse ullamcorper nisl quis augue dapibus mattis. Donec tincidunt, nulla volutpat placerat ultricies, orci nisi facilisis velit, id pretium arcu nibh mattis augue.', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_content_type']				= 'featured_about_page';
	
	$baseball_sports_club_defaults['featured_about_info_title2']	    				= esc_html__( 'Our Mission', 'baseball-sports-club' );
	$baseball_sports_club_defaults['featured_about_info_title3']	    				= esc_html__( 'Our Vision', 'baseball-sports-club' );
	// Inner Blog Page	
	
	$baseball_sports_club_defaults['featured_bloginn_botton_text']				= esc_html__( 'Read More', 'baseball-sports-club' );

	return $baseball_sports_club_defaults;

}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'baseball_sports_club_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function baseball_sports_club_get_option( $key ) {

		$default_options = baseball_sports_club_get_default_theme_options();
		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;