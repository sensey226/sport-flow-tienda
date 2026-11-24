<?php
/**
 * Features Section options.
 *
 * @package baseball-sports-club
 */

$baseball_sports_club_default = baseball_sports_club_get_default_theme_options();

  /** Feature Info section */
    $wp_customize->add_section(
        'featured_feature_info_section',
        array(
            'title'    => __( 'Feature Info', 'baseball-sports-club' ),      
            'priority' => 1,
            'panel'      => 'baseball_sports_club_section_panel',       	
        )
    );

    // Enable Section
    $wp_customize->add_setting('enable_featured_features_section', 
        array(
        'default' 			=> $baseball_sports_club_default['enable_featured_features_section'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'baseball_sports_club_sanitize_switch'
        )
    );
    $wp_customize->add_control('enable_featured_features_section', 
        array(		
        'label' 	=> __('Enable Section', 'baseball-sports-club'),
        'section' 	=> 'featured_feature_info_section',
        'settings'  => 'enable_featured_features_section',
        'type' 		=> 'checkbox',	
        )
    );

//Section BG Image
    $wp_customize->add_setting( 'baseball_sports_club_featured_features_img', array(  
        'sanitize_callback' => 'baseball_sports_club_sanitise_custom_url'
        ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'baseball_sports_club_featured_features_img', array(
            'label'      => __( 'Section BG Image', 'baseball-sports-club' ),
            'section'    => 'featured_feature_info_section',
            'settings'   => 'baseball_sports_club_featured_features_img',
    )));

//Opacity  

    $wp_customize->add_setting('baseball_sports_club_featured_features_opacity', 
        array(
        'default'           => 1,   
        'sanitize_callback' => 'baseball_sports_club_sanitize_number_range'
        ));
    $wp_customize->add_control('baseball_sports_club_featured_features_opacity', 
        array(
        'label'             => __('BG Opacity', 'baseball-sports-club'),
        'description'   => __( 'It Will Only apply on Image', 'baseball-sports-club' ),
        'section'           => 'featured_feature_info_section',   
        'settings'          => 'baseball_sports_club_featured_features_opacity', 
        'type'              => 'range', 
        'input_attrs'       => array(
        'min'           => 0,
        'max'           => 1,
        'step'          => 0.1,
        ),       

    ));

    $wp_customize->add_setting('baseball_sports_club_featured_features_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'baseball_sports_club_sanitize_choices',
    ));
    $wp_customize->add_control('baseball_sports_club_featured_features_onload_effects',array(
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
            'flip-up' => __('Flip Up','baseball-sports-club'),
            'none' => __('none','baseball-sports-club')
        ),
        'section' => 'featured_feature_info_section',
    ));


// // Items
$wp_customize->add_setting('number_of_featured_features_items', 
	array(
	'default' 			=> $baseball_sports_club_default['number_of_featured_features_items'],	
	'sanitize_callback' => 'baseball_sports_club_sanitize_number_range'
	)
);
$wp_customize->add_control('number_of_featured_features_items', 
	array(
	'label'       => __('Number Of Feature To Show', 'baseball-sports-club'),
	'section'     => 'featured_feature_info_section',   
	'settings'    => 'number_of_featured_features_items',		
	'type'        => 'number',
	'active_callback' => 'baseball_sports_club_featured_slider_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 6,
			'step'	=> 1,
		),
	)
);

// ////////// Icon1
$wp_customize->add_setting('baseball_sports_club_featured_icon', array(
    'default'   => 'fa-hourglass-start',
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_text',
));
$wp_customize->add_control(new baseball_sports_club_Custom_Text_Control($wp_customize, 'baseball_sports_club_featured_icon', array(
    'label'      => esc_html__('Featured Icon 1', 'baseball-sports-club'),
    'section'    => 'featured_feature_info_section',
    'settings'   => 'baseball_sports_club_featured_icon',
    'type' => 'text',
)));  

// Section Text1
$wp_customize->add_setting('featured_about_section_featuretext1', 
array(
'default'           => 'Time Spirit',
'type'              => 'theme_mod',
'capability'        => 'edit_theme_options',	
'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control('featured_about_section_featuretext1', 
array(
'label'       => __('Featured Text 1', 'baseball-sports-club'),
'section'     => 'featured_feature_info_section',   
'settings'    => 'featured_about_section_featuretext1',				
'type'        => 'text'
)
);

// Section sub Text1
$wp_customize->add_setting('featured_about_section_featuresubtext1', 
array(
'default'           => 'Etiam ornare lorem in bibendum pretium. Ut purus libero, consequat sed porttitor at, ullamcorper ut velit.',
'type'              => 'theme_mod',
'capability'        => 'edit_theme_options',	
'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control('featured_about_section_featuresubtext1', 
array(
'label'       => __('Sub Featured Text 1', 'baseball-sports-club'),
'section'     => 'featured_feature_info_section',   
'settings'    => 'featured_about_section_featuresubtext1',				
'type'        => 'textarea'
)
);

// ////////// Icon2
$wp_customize->add_setting('baseball_sports_club_featured_icon2', array(
    'default'   => 'fa-handshake-angle',
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_text',
));
$wp_customize->add_control(new baseball_sports_club_Custom_Text_Control($wp_customize, 'baseball_sports_club_featured_icon2', array(
    'label'      => esc_html__('Featured Icon 2', 'baseball-sports-club'),
    'section'    => 'featured_feature_info_section',
    'settings'   => 'baseball_sports_club_featured_icon2',
    'type' => 'text',
)));  

// Section Text2
$wp_customize->add_setting('featured_about_section_featuretext2', 
array(
'default'           => 'Physical Fitness',
'type'              => 'theme_mod',
'capability'        => 'edit_theme_options',	
'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control('featured_about_section_featuretext2', 
array(
'label'       => __('Featured Text 2', 'baseball-sports-club'),
'section'     => 'featured_feature_info_section',   
'settings'    => 'featured_about_section_featuretext2',				
'type'        => 'text'
)
);

// Section sub Text2
$wp_customize->add_setting('featured_about_section_featuresubtext2', 
array(
'default'           => 'Etiam ornare lorem in bibendum pretium. Ut purus libero, consequat sed porttitor at, ullamcorper ut velit.',
'type'              => 'theme_mod',
'capability'        => 'edit_theme_options',	
'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control('featured_about_section_featuresubtext2', 
array(
'label'       => __('Sub Featured Text 2', 'baseball-sports-club'),
'section'     => 'featured_feature_info_section',   
'settings'    => 'featured_about_section_featuresubtext2',				
'type'        => 'textarea'
)
);

// ////////// Icon3
$wp_customize->add_setting('baseball_sports_club_featured_icon3', array(
    'default'   => 'fa-dumpster-fire',
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_text',
));
$wp_customize->add_control(new baseball_sports_club_Custom_Text_Control($wp_customize, 'baseball_sports_club_featured_icon3', array(
    'label'      => esc_html__('Featured Icon 3', 'baseball-sports-club'),
    'section'    => 'featured_feature_info_section',
    'settings'   => 'baseball_sports_club_featured_icon3',
    'type' => 'text',
)));  

// Section Text3
$wp_customize->add_setting('featured_about_section_featuretext3', 
array(
'default'           => 'Training Camps',
'type'              => 'theme_mod',
'capability'        => 'edit_theme_options',	
'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control('featured_about_section_featuretext3', 
array(
'label'       => __('Featured Text 3', 'baseball-sports-club'),
'section'     => 'featured_feature_info_section',   
'settings'    => 'featured_about_section_featuretext3',				
'type'        => 'text'
)
);

// Section sub Text3
$wp_customize->add_setting('featured_about_section_featuresubtext3', 
array(
'default'           => 'Etiam ornare lorem in bibendum pretium. Ut purus libero, consequat sed porttitor at, ullamcorper ut velit.',
'type'              => 'theme_mod',
'capability'        => 'edit_theme_options',	
'sanitize_callback' => 'sanitize_text_field'
)
);
$wp_customize->add_control('featured_about_section_featuresubtext3', 
array(
'label'       => __('Sub Featured Text 3', 'baseball-sports-club'),
'section'     => 'featured_feature_info_section',   
'settings'    => 'featured_about_section_featuresubtext3',				
'type'        => 'textarea'
)
);

// ///////// Icons Color
$wp_customize->add_setting('featured_icons_color', array(
    'default'   => '#da0001',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'featured_icons_color', array(
    'section' => 'featured_feature_info_section',
    'label'      => esc_html__('Icons Color', 'baseball-sports-club'),
    )));

    // /////////Title Color
$wp_customize->add_setting('featured_title_color', array(
    'default'   => '#fff',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'featured_title_color', array(
    'section' => 'featured_feature_info_section',
    'label'      => esc_html__('Title Color', 'baseball-sports-club'),
    )));

    // /////////Title Color
$wp_customize->add_setting('featured_text_color', array(
    'default'   => '#afafaf',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'featured_text_color', array(
    'section' => 'featured_feature_info_section',
    'label'      => esc_html__('Text Color', 'baseball-sports-club'),
    )));