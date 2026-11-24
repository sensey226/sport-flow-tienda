<?php
/**
 * About Section options.
 *
 * @package baseball-sports-club 
 */

$baseball_sports_club_default = baseball_sports_club_get_default_theme_options();

/** About Info section */
$wp_customize->add_section(
    'featured_about_info_section',
    array(
        'title'    => __( 'About Info', 'baseball-sports-club' ),      
        'priority' => 1,
        'panel'      => 'baseball_sports_club_section_panel',       	
    )
);

// Enable Section
$wp_customize->add_setting('enable_featured_about_section', 
	array(
	'default' 			=> $baseball_sports_club_default['enable_featured_about_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'baseball_sports_club_sanitize_switch'
	)
);

$wp_customize->add_control('enable_featured_about_section', 
	array(		
	'label' 	=> __('Enable Section', 'baseball-sports-club'),
	'section' 	=> 'featured_about_info_section',
	'settings'  => 'enable_featured_about_section',
	'type' 		=> 'checkbox',	
	)
);

//Section BG Image
    $wp_customize->add_setting( 'baseball_sports_club_featured_about_img', array(  
        'sanitize_callback' => 'baseball_sports_club_sanitise_custom_url'
        ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'baseball_sports_club_featured_about_img', array(
            'label'      => __( 'Section BG Image', 'baseball-sports-club' ),
            'section'    => 'featured_about_info_section',
            'settings'   => 'baseball_sports_club_featured_about_img',
    )));
//Opacity  
    $wp_customize->add_setting('baseball_sports_club_featured_about_opacity', 
        array(
        'default'           => 1,   
        'sanitize_callback' => 'baseball_sports_club_sanitize_number_range'
        ));
    $wp_customize->add_control('baseball_sports_club_featured_about_opacity', 
        array(
        'label'             => __('BG Opacity', 'baseball-sports-club'),
        'description'   => __( 'It Will Only apply on Image', 'baseball-sports-club' ),
        'section'           => 'featured_about_info_section',   
        'settings'          => 'baseball_sports_club_featured_about_opacity', 
        'type'              => 'range', 
        'input_attrs'       => array(
        'min'           => 0,
        'max'           => 1,
        'step'          => 0.1,
        ),       

    ));

    $wp_customize->add_setting('baseball_sports_club_featured_about_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'baseball_sports_club_sanitize_choices',
    ));
    $wp_customize->add_control('baseball_sports_club_featured_about_onload_effects',array(
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
        'section' => 'featured_about_info_section',
    ));

    $wp_customize->add_setting( 'baseball_sports_club_about_youtube_image', array(  
        'sanitize_callback' => 'baseball_sports_club_sanitise_custom_url'
        ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'baseball_sports_club_about_youtube_image', array(
        'label' => __('You Tube Image','baseball-sports-club'),
        'section' => 'featured_about_info_section',
        'settings'   => 'baseball_sports_club_about_youtube_image',
    )));

// Section Title
$wp_customize->add_setting('theme_options[featured_about_section_subword]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_section_subword'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_section_subword]', 
    array(
        'label'       => __('Sub Heading First Word', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_section_subword]',		
        'type'        => 'text'
    )
);

$wp_customize->add_setting('subheading_first_word_color', array(
    'default'   => '#000',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'subheading_first_word_color', array(
    'section' => 'featured_about_info_section',
    'label' => __('Sub Heading First Word Color', 'baseball-sports-club'),
    )));

// // Section Title
$wp_customize->add_setting('theme_options[featured_about_section_title1]', 
	array(
	'default'           => $baseball_sports_club_default['featured_about_section_title1'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control('theme_options[featured_about_section_title1]', 
	array(
	'label'       => __('Sub Heading', 'baseball-sports-club'),
	'section'     => 'featured_about_info_section',   
	'settings'    => 'theme_options[featured_about_section_title1]',		
	'type'        => 'text'
	)
);

$wp_customize->add_setting('subheading_second_word_color', array(
    'default'   => '#000',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'subheading_second_word_color', array(
    'section' => 'featured_about_info_section',
    'label' => __('Sub Heading Color', 'baseball-sports-club'),
    )));

// // Section Title
$wp_customize->add_setting('theme_options[featured_about_section_title2]', 
	array(
	'default'           => $baseball_sports_club_default['featured_about_section_title2'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control('theme_options[featured_about_section_title2]', 
	array(
	'label'       => __('Sub Heading', 'baseball-sports-club'),
	'section'     => 'featured_about_info_section',   
	'settings'    => 'theme_options[featured_about_section_title2]',		
	'type'        => 'text'
	)
);


// // main about image
$wp_customize->add_setting( 'baseball_sports_club_about1_image', array(  
'sanitize_callback' => 'baseball_sports_club_sanitise_custom_url'
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'baseball_sports_club_about1_image', array(
    'label' => __('About Image 1','baseball-sports-club'),
    'description'   => __( 'Size 350px x 400x', 'baseball-sports-club' ),
    'section' => 'featured_about_info_section',
    'settings'   => 'baseball_sports_club_about1_image',
)));
// ///////
$wp_customize->add_setting( 'baseball_sports_club_about2_image', array(  
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_url'
    ));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'baseball_sports_club_about2_image', array(
    'label' => __('About Image 2','baseball-sports-club'),
    'description'   => __( 'Size 250px x 350x', 'baseball-sports-club' ),
    'section' => 'featured_about_info_section',
    'settings'   => 'baseball_sports_club_about2_image',
)));

// //////////////

$wp_customize->add_setting('theme_options[featured_about_section_number]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_section_number'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_section_number]', 
    array(
        'label'       => __('Number', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_section_number]',				
        'type'        => 'text'
    )
);

$wp_customize->add_setting('theme_options[featured_about_section_numtext]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_section_numtext'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_section_numtext]', 
    array(
        'label'       => __('Text', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_section_numtext]',				
        'type'        => 'text'
    )
);


$wp_customize->add_setting('theme_options[featured_about_info_title1]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_info_title1'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_info_title1]', 
    array(
        'label'       => __('Info Title 1', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_info_title1]',				
        'type'        => 'text'
    )
);
// //////
$wp_customize->add_setting('theme_options[featured_about_info_text1]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_info_text1'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_info_text1]', 
    array(
        'label'       => __('Info Text 1', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_info_text1]',				
        'type'        => 'text'
    )
);
// // ////
$wp_customize->add_setting('theme_options[featured_about_info_title2]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_info_title2'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_info_title2]', 
    array(
        'label'       => __('Info Title 2', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_info_title2]',				
        'type'        => 'text'
    )
);
// //////
$wp_customize->add_setting('theme_options[featured_about_info_text2]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_info_text2'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_info_text2]', 
    array(
        'label'       => __('Info Text 2', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_info_text2]',				
        'type'        => 'text'
    )
);

$wp_customize->add_setting('theme_options[featured_about_info_title3]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_info_title3'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_info_title3]', 
    array(
        'label'       => __('Info Title 3', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_info_title3]',				
        'type'        => 'text'
    )
);
// //////
$wp_customize->add_setting('theme_options[featured_about_info_text3]', 
    array(
        'default'           => $baseball_sports_club_default['featured_about_info_text3'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control('theme_options[featured_about_info_text3]', 
    array(
        'label'       => __('Info Text 3', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_info_text3]',				
        'type'        => 'text'
    )
);

// // /////////featur about plans and icon  /// 
$baseball_sports_club_feature_count = 4; 

for ($i = 1; $i <= $baseball_sports_club_feature_count; $i++) {
    // Icon setting
	
    $wp_customize->add_setting(sprintf(__('theme_options[featured_iconabout]', 'baseball-sports-club') , $i), 
        array(
            'default'           => $baseball_sports_club_default["featured_iconabout" . $i],
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
	
    $wp_customize->add_control(sprintf(__('theme_options[featured_iconabout]', 'baseball-sports-club') , $i), 
        array(
            'label'       		=> __("Plan Icon", 'baseball-sports-club') , $i,
            'section'     		=> 'featured_about_info_section',   
            'settings'    		=> sprintf(__('theme_options[featured_iconabout]' , 'baseball-sports-club') , $i),
            'type'        		=> 'text',
        )
    );

    // Title setting
    $wp_customize->add_setting(sprintf(__('theme_options[featured_about_section_bxtitle]', 'baseball-sports-club') , $i), 
        array(
            'default'           => sprintf($baseball_sports_club_default['featured_about_section_bxtitle' . $i] ),
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(sprintf(__('theme_options[featured_about_section_bxtitle]', 'baseball-sports-club') , $i),
        array(
            'label'       => __('Plan Title', 'baseball-sports-club'), $i,
            'section'     => 'featured_about_info_section',   
            'settings'    => sprintf(__('theme_options[featured_about_section_bxtitle]' , 'baseball-sports-club') , $i),				
            'type'        => 'text'
        )
    );
}

// //   ////// button //////
    $wp_customize->add_setting('theme_options[featured_about_section_buttontext]', 
        array(
        'default'           => $baseball_sports_club_default['featured_about_section_buttontext'],
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',	
        'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control('theme_options[featured_about_section_buttontext]', 
        array(
        'label'       => __('Button Text', 'baseball-sports-club'),
        'section'     => 'featured_about_info_section',   
        'settings'    => 'theme_options[featured_about_section_buttontext]',				
        'type'        => 'text'
        )
    );

    // /////////Title Color
$wp_customize->add_setting('about_info_active_title_color', array(
    'default'   => '#da0001',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_info_active_title_color', array(
    'section' => 'featured_about_info_section',
    'label'      => esc_html__('About Active Title Color', 'baseball-sports-club'),
    )));

    $wp_customize->add_setting('about_info_deactive_title_color', array(
    'default'   => '#afafaf',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_info_deactive_title_color', array(
    'section' => 'featured_about_info_section',
    'label'      => esc_html__('About Deactive Title Color', 'baseball-sports-club'),
    )));

