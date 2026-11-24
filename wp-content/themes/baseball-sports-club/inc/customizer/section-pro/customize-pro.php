<?php
/**
 * sectionpro Theme Options
 *
 * @package baseball-sports-club
 */

$wp_customize->add_section( 'baseball_sports_club_sectionpro_section' , array(
	'title'      => esc_html__( 'sectionpro Section', 'baseball-sports-club' ),
	'capability' => 'edit_theme_options',
	'panel' => 'baseball_sports_club_section_pro_panel'
) );

// /////////// LOGO
$wp_customize->add_setting('baseball_sports_club_footer_logo1', array(
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_url',       
    'capability' => 'edit_theme_options',        
    'type' => 'theme_mod',
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'baseball_sports_club_footer_logo1', array(       
    'label'      => esc_html__('Logo Image', 'baseball-sports-club'),       
    'section'    => 'baseball_sports_club_sectionpro_section',       
    'settings'   => 'baseball_sports_club_footer_logo1',
)));