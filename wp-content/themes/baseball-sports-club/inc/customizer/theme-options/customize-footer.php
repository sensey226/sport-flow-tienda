<?php
/**
 * Footer Theme Options
 *
 * @package baseball-sports-club
 */

$wp_customize->add_section( 'baseball_sports_club_footer_section' , array(
	'title'      => esc_html__( 'Footer Section', 'baseball-sports-club' ),
	'capability' => 'edit_theme_options',
	'panel' => 'baseball_sports_club_theme_section_panel'
) );

// /////////// LOGO
$wp_customize->add_setting('baseball_sports_club_footer_logo', array(
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_url',       
    'capability' => 'edit_theme_options',        
    'type' => 'theme_mod',
));

$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'baseball_sports_club_footer_logo', array(       
    'label'      => esc_html__('Logo Image', 'baseball-sports-club'),       
    'section'    => 'baseball_sports_club_footer_section',       
    'settings'   => 'baseball_sports_club_footer_logo',
)));

// ////////// Paragraph
$wp_customize->add_setting( 'baseball_sports_club_foot_paragraph' , array(
    'default'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp or incididunt ut labore et dolore magna aliqua.',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_paragraph', array(   
    'label'      => esc_html__( 'Paragraph', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_paragraph',   
    'type' => 'text',         
) ) );

// ////////// Facebook Icon
$wp_customize->add_setting('baseball_sports_club_footfacebook_icon', array(
    'default'   => 'fa-facebook-f',
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_text',
));
$wp_customize->add_control(new baseball_sports_club_Custom_Text_Control($wp_customize, 'baseball_sports_club_footfacebook_icon', array(
    'label'      => esc_html__('Facebook Icon', 'baseball-sports-club'),
    'section'    => 'baseball_sports_club_footer_section',
    'settings'   => 'baseball_sports_club_footfacebook_icon',
    'type' => 'text',
)));  

// ////////// Twitter Icon
$wp_customize->add_setting('baseball_sports_club_foottwitter_icon', array(
    'default'   => 'fa-twitter',
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_text',
));
$wp_customize->add_control(new baseball_sports_club_Custom_Text_Control($wp_customize, 'baseball_sports_club_foottwitter_icon', array(
    'label'      => esc_html__('Twitter Icon', 'baseball-sports-club'),
    'section'    => 'baseball_sports_club_footer_section',
    'settings'   => 'baseball_sports_club_foottwitter_icon',
    'type' => 'text',
))); 

// ////////// Linkedin Icon
$wp_customize->add_setting('baseball_sports_club_footlinkedin_icon', array(
    'default'   => 'fa-linkedin-in',
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_text',
));
$wp_customize->add_control(new baseball_sports_club_Custom_Text_Control($wp_customize, 'baseball_sports_club_footlinkedin_icon', array(
    'label'      => esc_html__('Linkedin Icon', 'baseball-sports-club'),
    'section'    => 'baseball_sports_club_footer_section',
    'settings'   => 'baseball_sports_club_footlinkedin_icon',
    'type' => 'text',
)));

// ////////// Instagram Icon
$wp_customize->add_setting('baseball_sports_club_footinstagram_icon', array(
    'default'   => 'fa-instagram',
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_text',
));
$wp_customize->add_control(new baseball_sports_club_Custom_Text_Control($wp_customize, 'baseball_sports_club_footinstagram_icon', array(
    'label'      => esc_html__('Instagram Icon', 'baseball-sports-club'),
    'section'    => 'baseball_sports_club_footer_section',
    'settings'   => 'baseball_sports_club_footinstagram_icon',
    'type' => 'text',
)));

// Separator (hr)    
    $wp_customize->add_control('baseball_sports_club_footer_separator1',array(
        'label' => __('Footer Menu 1','baseball-sports-club'),
        'section' => 'baseball_sports_club_footer_section'
    ));

// ////////// Title 1
$wp_customize->add_setting( 'baseball_sports_club_foot_title1' , array(
    'default'   => 'Quick Links',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_title1', array(   
    'label'      => esc_html__( 'Title 1', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_title1',   
    'type' => 'text',         
) ) );

// ////////// Quick Links Submenu 1
$wp_customize->add_setting( 'baseball_sports_club_foot_abtsubmenu1' , array(
    'default'   => 'Home',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_abtsubmenu1', array(   
    'label'      => esc_html__( 'About Submenu 1', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_abtsubmenu1',   
    'type' => 'text',         
) ) );

// ////////// Quick Links Submenu 2
$wp_customize->add_setting( 'baseball_sports_club_foot_abtsubmenu2' , array(
    'default'   => 'About Us',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_abtsubmenu2', array(   
    'label'      => esc_html__( 'About Submenu 2', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_abtsubmenu2',   
    'type' => 'text',         
) ) );

// ////////// Quick Links Submenu 3
$wp_customize->add_setting( 'prime_onstruction_foot_abtsubmenu3' , array(
    'default'   => 'Services',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_abtsubmenu3', array(   
    'label'      => esc_html__( 'About Submenu 3', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_abtsubmenu3',   
    'type' => 'text',         
) ) );

// ////////// Quick Links Submenu 4
$wp_customize->add_setting( 'baseball_sports_club_foot_abtsubmenu4' , array(
    'default'   => 'Blog',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_abtsubmenu4', array(   
    'label'      => esc_html__( 'About Submenu 4', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_abtsubmenu4',   
    'type' => 'text',         
) ) );

// ////////// Quick Links Submenu 5
$wp_customize->add_setting( 'baseball_sports_club_foot_abtsubmenu5' , array(
    'default'   => 'Contact Us',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_abtsubmenu5', array(   
    'label'      => esc_html__( 'About Submenu 5', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_abtsubmenu5',   
    'type' => 'text',         
) ) );

// Separator (hr)
$wp_customize->add_control('baseball_sports_club_footer_separator2',array(
    'label' => __('Footer Menu 2','baseball-sports-club'),
    'section' => 'baseball_sports_club_footer_section'
));

// ////////// Title 2
$wp_customize->add_setting( 'baseball_sports_club_foot_title2' , array(
    'default'   => 'Gallery Widget',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_title2', array(   
    'label'      => esc_html__( 'Title 2', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_title2',   
    'type' => 'text',         
) ) );

// ////////// Gallery Submenu 1
$wp_customize->add_setting( 'baseball_sports_club_foot_navsubmenu1' , array(
    'default'   => 'About Club',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_navsubmenu1', array(   
    'label'      => esc_html__( 'Navigation Submenu 1', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_navsubmenu1',   
    'type' => 'text',         
) ) );

// ////////// Gallery Submenu 2
$wp_customize->add_setting( 'baseball_sports_club_foot_navsubmenu2' , array(
    'default'   => 'Media',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_navsubmenu2', array(   
    'label'      => esc_html__( 'Navigation Submenu 2', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_navsubmenu2',   
    'type' => 'text',         
) ) );

// ////////// Gallery Submenu 3
$wp_customize->add_setting( 'baseball_sports_club_foot_navsubmenu3' , array(
    'default'   => 'Donation',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_navsubmenu3', array(   
    'label'      => esc_html__( 'Navigation Submenu 3', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_navsubmenu3',   
    'type' => 'text',         
) ) );

// ////////// Gallery Submenu 4
$wp_customize->add_setting( 'baseball_sports_club_foot_navsubmenu4' , array(
    'default'   => 'Pages',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_navsubmenu4', array(   
    'label'      => esc_html__( 'Navigation Submenu 4', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_navsubmenu4',   
    'type' => 'text',         
) ) );

// ////////// Gallery Submenu 5
$wp_customize->add_setting( 'baseball_sports_club_foot_navsubmenu5' , array(
    'default'   => 'Terms Of Policies',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_navsubmenu5', array(   
    'label'      => esc_html__( 'Navigation Submenu 5', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_navsubmenu5',   
    'type' => 'text',         
) ) );

// Separator (hr)
$wp_customize->add_control('baseball_sports_club_footer_separator3',array(
    'label' => __('Footer Menu 3','baseball-sports-club'),
    'section' => 'baseball_sports_club_footer_section'
));

// ////////// Title 3
$wp_customize->add_setting( 'baseball_sports_club_foot_title3' , array(
    'default'   => 'SUBSCRIBE & GET THE UPDATED NEWS',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_title3', array(   
    'label'      => esc_html__( 'Title 3', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_title3',   
    'type' => 'text',         
) ) );

// ////////// Our Services Submenu 1
$wp_customize->add_setting( 'baseball_sports_club_foot_buttonText' , array(
    'default'   => 'SUBSCRIBE',   
    'sanitize_callback' => 'baseball_sports_club_sanitise_custom_texttitle',    
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'baseball_sports_club_foot_buttonText', array(   
    'label'      => esc_html__( 'Button Text', 'baseball-sports-club' ),   
    'section'    => 'baseball_sports_club_footer_section',   
    'settings'   => 'baseball_sports_club_foot_buttonText',   
    'type' => 'text',         
) ) );