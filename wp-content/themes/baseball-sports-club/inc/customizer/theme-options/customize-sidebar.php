<?php

/**
 * Sidebar Theme Options
 *
 * @package baseball-sports-club
 */
$wp_customize->add_section('baseball_sports_club_sidebar_section', array(

	'title'      => esc_html__('Sidebar Section', 'baseball-sports-club'),
	'capability' => 'edit_theme_options',
	'panel' => 'baseball_sports_club_theme_section_panel'

));

// ///////// Search Background Color
 $wp_customize->add_setting('Search_background_color', array(
    'default'   => '#000',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Search_background_color', array(
    'section' => 'baseball_sports_club_sidebar_section',
    'description' => __('Heading Background Color', 'baseball-sports-club'),
    )));

// ////////// Heading Text Color
$wp_customize->add_setting('Heading_text_color', array(
    'default'   => '#fff',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Heading_text_color', array(
    'section' => 'baseball_sports_club_sidebar_section',
    'description' => __('Heading Text Color', 'baseball-sports-club'),
    )));

    // ////////// Text Color
$wp_customize->add_setting('Text_color', array(
    'default'   => '#363636',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Text_color', array(
    'section' => 'baseball_sports_club_sidebar_section',
    'description' => __('Text Color', 'baseball-sports-club'),
    )));

    $wp_customize->add_setting('sidebar_headingtext_case',array(
        'default' => 'Capitalize',
        'sanitize_callback' => 'baseball_sports_club_sanitize_choices',
    ));
    $wp_customize->add_control('sidebar_headingtext_case',array(
        'type' => 'select',
        'label' => __('Title Case','baseball-sports-club'),
        'choices' => array (
            'Uppercase' => __('Uppercase','baseball-sports-club'),
            'Lowercase' => __('Lowercase','baseball-sports-club'),
            'Capitalize' => __('Capitalize','baseball-sports-club'),
            'None' => __('None','baseball-sports-club')
        ),
        'section' => 'baseball_sports_club_sidebar_section',
    ));

    // ////////// Button Bg Color
$wp_customize->add_setting('Search_button_bg_color', array(
    'default'   => '#da0001 ',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Search_button_bg_color', array(
    'section' => 'baseball_sports_club_sidebar_section',
    'description' => __('Search Button Bg Color', 'baseball-sports-club'),
    )));

// ////////// Button text Color
$wp_customize->add_setting('Search_button_text_color', array(
    'default'   => '#fff ',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Search_button_text_color', array(
    'section' => 'baseball_sports_club_sidebar_section',
    'description' => __('Search Button Text Color', 'baseball-sports-club'),
    )));

