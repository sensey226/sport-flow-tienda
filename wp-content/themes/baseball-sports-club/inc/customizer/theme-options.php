<?php
/**
 * Footer Options
 *
 * @package baseball-sports-club
 */

$wp_customize->add_panel(
        'baseball_sports_club_theme_section_panel',
        [
           'priority' => 30,
           'capability' => 'edit_theme_options',
           'title' => esc_html__('Theme Option Section', 'baseball-sports-club'),
        ]
    );

//Header Section.
require get_template_directory() . '/inc/customizer/theme-options/customize-header.php';

//Footer Section.
require get_template_directory() . '/inc/customizer/theme-options/customize-footer.php';

//Sidebar Section.
require get_template_directory() . '/inc/customizer/theme-options/customize-sidebar.php';

//Post Section.
require get_template_directory() . '/inc/customizer/theme-options/customize-post.php';


