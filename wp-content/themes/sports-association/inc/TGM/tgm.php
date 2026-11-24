<?php
	
load_template( get_template_directory() . '/inc/TGM/class-tgm-plugin-activation.php' );

/**
 * Recommended plugins.
 */
function sports_association_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'      => esc_html__( 'Video Popup Block by WPZOOM', 'sports-association' ),
			'slug'      => 'wpzoom-video-popup-block',
			'required'  => false,
		),
		array(
			'name'      => esc_html__( 'Siteready Coming Soon Under Construction', 'sports-association' ),
			'slug'      => 'siteready-coming-soon-under-construction',
			'required'  => false,
		)
	);
	$config = array();
	sports_association_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'sports_association_register_recommended_plugins' );