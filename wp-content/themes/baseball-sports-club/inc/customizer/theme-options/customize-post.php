<?php

/**
 * Sidebar Theme Options
 *
 * @package baseball-sports-club
 */
$wp_customize->add_section('baseball_sports_club_post_section', array(

	'title'      => esc_html__('Post Section', 'baseball-sports-club'),
	'capability' => 'edit_theme_options',
	'panel' => 'baseball_sports_club_theme_section_panel'

));

// ///////// Post title Color
 $wp_customize->add_setting('post_title_color', array(
    'default'   => '#000',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_title_color', array(
    'section' => 'baseball_sports_club_post_section',
    'description' => __('Post Title Color', 'baseball-sports-club'),
    )));

    // ///////// Post calender icon Color
 $wp_customize->add_setting('calender_icon_color', array(
    'default'   => '#da0001',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'calender_icon_color', array(
    'section' => 'baseball_sports_club_post_section',
    'description' => __('Calender Icon Color', 'baseball-sports-club'),
    )));

    // ///////// Post comment icon Color
 $wp_customize->add_setting('comment_icon_color', array(
    'default'   => '#da0001',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'comment_icon_color', array(
    'section' => 'baseball_sports_club_post_section',
    'description' => __('Comment Icon Color', 'baseball-sports-club'),
    )));

    // ///////// Post date text Color
 $wp_customize->add_setting('post_date_text_color', array(
    'default'   => '#000',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_date_text_color', array(
    'section' => 'baseball_sports_club_post_section',
    'description' => __('Post Date Text Color', 'baseball-sports-club'),
    )));

    // ///////// Post comment text Color
 $wp_customize->add_setting('post_comment_text_color', array(
    'default'   => '#000',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_comment_text_color', array(
    'section' => 'baseball_sports_club_post_section',
    'description' => __('Post Comment Text Color', 'baseball-sports-club'),
    )));

    // ///////// Post comment text Color
 $wp_customize->add_setting('post_text_color', array(
    'default'   => '#707070',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_text_color', array(
    'section' => 'baseball_sports_club_post_section',
    'description' => __('Post Text Color', 'baseball-sports-club'),
    )));

    // ///////// Post Readmore bg Color
 $wp_customize->add_setting('post_readmore_bg_color', array(
    'default'   => '#000',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_readmore_bg_color', array(
    'section' => 'baseball_sports_club_post_section',
    'description' => __('Post ReadMore Bg Color', 'baseball-sports-club'),
    )));

    // ///////// Post Readmore text Color
 $wp_customize->add_setting('post_readmore_text_color', array(
    'default'   => '#fff',
    'transport' => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'post_readmore_text_color', array(
    'section' => 'baseball_sports_club_post_section',
    'description' => __('Post ReadMore Text Color', 'baseball-sports-club'),
    )));


