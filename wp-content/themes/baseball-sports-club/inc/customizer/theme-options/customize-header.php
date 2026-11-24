<?php

/**
 * Header Theme Options
 *
 * @package baseball-sports-club
 */
$wp_customize->add_section('baseball_sports_club_header_section', array(

	'title'      => esc_html__('Header Section', 'baseball-sports-club'),
	'capability' => 'edit_theme_options',
	'panel' => 'baseball_sports_club_theme_section_panel'

));

// ////////// Phone Icon
$wp_customize->add_setting('baseball_sports_club_call_icon', array(
    'default'   => 'fa-phone-volume',
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_text',
));
$wp_customize->add_control(new baseball_sports_club_Custom_Text_Control($wp_customize, 'baseball_sports_club_call_icon', array(
    'label'      => esc_html__('Call Icon', 'baseball-sports-club'),
    'section'    => 'baseball_sports_club_header_section',
    'settings'   => 'baseball_sports_club_call_icon',
    'type' => 'text',
))); 

 // ///////// Phone Icon Text Color
 $wp_customize->add_setting('Phone_icon_color', array(
    'default'   => '#DA0001',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Phone_icon_color', array(
    'section' => 'baseball_sports_club_header_section',
    'description' => __('Phone Icon Color', 'baseball-sports-club'),
    )));

// //////////  Phone Number 
$wp_customize->add_setting( 'baseball_sports_club_head_calltitle' , array(
    'default'   => '+012 3456 789',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_head_calltitle', array(   
    'label'      => esc_html__( 'Phone Number', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_header_section',   
    'settings'   => 'baseball_sports_club_head_calltitle',   
    'type' => 'text',         
) ) );

 // ///////// Phone Text Color
 $wp_customize->add_setting('Phone_color', array(
    'default'   => '#fff',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Phone_color', array(
    'section' => 'baseball_sports_club_header_section',
    'description' => __('Phone Number Text Color', 'baseball-sports-club'),
    )));

    // ///////// Header Background Color
 $wp_customize->add_setting('Header_bg_color', array(
    'default'   => '#000000a2',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Header_bg_color', array(
    'section' => 'baseball_sports_club_header_section',
    'description' => __('Header Background Color', 'baseball-sports-club'),
    )));

    // ///////// Header Menu Text Color
 $wp_customize->add_setting('menu_text_color', array(
    'default'   => '#fff',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'menu_text_color', array(
    'section' => 'baseball_sports_club_header_section',
    'description' => __('Menu Text Color', 'baseball-sports-club'),
    )));

    //Image
$wp_customize->add_setting( 'baseball_sports_club_header_image1', array(  
        'sanitize_callback' => 'baseball_sports_club_sanitise_custom_url'
        ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'baseball_sports_club_header_image1', array(
            'label'      => __( 'Section Image', 'baseball-sports-club' ),
            'section'    => 'baseball_sports_club_header_section',
            'settings'   => 'baseball_sports_club_header_image1',
    )));


