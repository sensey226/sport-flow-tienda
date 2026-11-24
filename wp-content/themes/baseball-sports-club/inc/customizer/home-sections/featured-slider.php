<?php 
/**
 * Home Section
 *
 * @package baseball-sports-club
 */

$baseball_sports_club_default = baseball_sports_club_get_default_theme_options();

/** Slider Info section */
$wp_customize->add_section(
    'featured_slider_info_section',
    array(
        'title'    => __( 'Slider Info', 'baseball-sports-club' ),      
        'priority' => 1,
        'panel'      => 'baseball_sports_club_section_panel',       	
    )
);

// Enable Section
$wp_customize->add_setting(
    'slider_enable_section',
    array(
        'default' 			=> true,
       'sanitize_callback' => 'baseball_sports_club_sanitize_switch',

    )
);
$wp_customize->add_control(
    new Baseball_Sports_Club_Toggle_Checkbox_Custom_control(
        $wp_customize,
        'slider_enable_section',
        array(
            'settings'      => 'slider_enable_section',
            'section'       => 'featured_slider_info_section',
            'label'         => __( 'Enable Section', 'baseball-sports-club' ),
            'on_off_label'  => array(
                'on' => __( 'Yes', 'baseball-sports-club' ),
                'off' => __( 'No', 'baseball-sports-club' )
            ),
        )
    )
);

// /// effects
$wp_customize->add_setting('baseball_sports_club_featured_slider_onload_effects',array(
    'default' => 'Bounce In Up',
    'sanitize_callback' => 'baseball_sports_club_sanitize_choices',
));
$wp_customize->add_control('baseball_sports_club_featured_slider_onload_effects',array(
    'type' => 'select',
    'label' => __('Box Onload Transition Effects','baseball-sports-club'),
    'choices' => array (
        'wow bounceInLeft' => __('Bounce In Left','baseball-sports-club'),
        'wow bounceInRight' => __('Bounce In Right','baseball-sports-club'),
        'wow bounceInUp' => __('Bounce In Up','baseball-sports-club'),
        'wow bounceInDown' => __('Bounce In Down','baseball-sports-club'),
        'wow zoomIn' => __('Zoom In','baseball-sports-club'),
        'wow zoomOut' => __('Zoom Out','baseball-sports-club'),
        'wow fadeInDown' => __('Fade In Down','baseball-sports-club'),            
        'wow fadeInUp' => __('Fade In Up','baseball-sports-club'),
        'wow fadeInLeft' => __('Fade In Left','baseball-sports-club'),
        'wow fadeInRight' => __('Fade In Right','baseball-sports-club'),
        'flip-up' => __('Flip Up','baseball-sports-club')
    ),
    'section' => 'featured_slider_info_section',
)); 

// Items
// Number of Slider Items
$wp_customize->add_setting('number_of_featured_slider_items', array(
    'default'           => 3, // Set default number of items
    'sanitize_callback' => 'absint', // Ensure it's a valid integer
));

$wp_customize->add_control('number_of_featured_slider_items', array(
    'label'    => __('Number Of Slider To Show', 'baseball-sports-club'),
    'section'  => 'featured_slider_info_section', // The section where this control will appear
    'type'     => 'number',
    'input_attrs' => array(
        'min' => 1, // Minimum value
        'max' => 10, // Maximum value
        'step' => 1, // Increment step
    ),
));

$baseball_sports_club_slider_list = array();
$baseball_sports_club_args = array('post_type' => 'post'); // Fetch posts, not pages
$baseball_sports_club_posts = get_posts( $baseball_sports_club_args ); 
foreach($baseball_sports_club_posts as $baseball_sports_club_post) {
    $baseball_sports_club_slider_list[$baseball_sports_club_post->ID] = $baseball_sports_club_post->post_title; // Use post ID as key and title as value
}

for ( $baseball_sports_club_count = 1; $baseball_sports_club_count <= 4; $baseball_sports_club_count++ ) {
    $wp_customize->add_setting( 'select_post_slider' . $baseball_sports_club_count, array(
        'default'           => '',
        'sanitize_callback' => 'baseball_sports_club_sanitize_post_dropdown'
    ));
    $wp_customize->add_control( 'select_post_slider' . $baseball_sports_club_count, array(
        'label'   => __( 'Select A Post Page', 'baseball-sports-club' ),
        'section' => 'featured_slider_info_section',
        'type'    => 'select', // Use 'select' for custom post list
        'choices' => $baseball_sports_club_slider_list // Populate choices with posts
    ));
}
    ////////// Button

$wp_customize->add_setting('baseball_sports_club_button1_text', 
    array(
    'default'           => __('Get In Touch', 'baseball-sports-club'),
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',    
    'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control('baseball_sports_club_button1_text', 
    array(
    'label'       => __('Get In Touch Button Text', 'baseball-sports-club'),
    'section'     => 'featured_slider_info_section',   
    'settings'    => 'baseball_sports_club_button1_text',           
    'type'        => 'text'
    )
);
// ///////// Get In Touch Text Color
 $wp_customize->add_setting('GetTouchButton_color', array(
    'default'   => '#fff',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'GetTouchButton_color', array(
    'section' => 'featured_slider_info_section',
    'description' => __('Get Touch Button Text Color', 'baseball-sports-club'),
    )));
    
    // ///////// Get In Touch Background Color
 $wp_customize->add_setting('GetTouchButton_bgcolor', array(
    'default'   => '#000',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'GetTouchButton_bgcolor', array(
    'section' => 'featured_slider_info_section',
    'description' => __('Button Background Color', 'baseball-sports-club'),
    )));

    // ///////// Get In Touch Background Color
 $wp_customize->add_setting('GetTouchButton_hovercolor', array(
    'default'   => '#da0001',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'GetTouchButton_hovercolor', array(
    'section' => 'featured_slider_info_section',
    'description' => __('Button Hover Color', 'baseball-sports-club'),
    )));