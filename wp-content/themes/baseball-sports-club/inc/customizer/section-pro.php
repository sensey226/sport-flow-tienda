<?php
/**
 * Sections Options
 *
 * @package baseball-sports-club
 */

$wp_customize->add_panel(
        'baseball_sports_club_section_pro_panel',
        [
           'priority' => 1,
           'capability' => 'edit_theme_options',
           'title' => esc_html__('baseball_sports_club Pro', 'baseball-sports-club'),
        ]
    );

//Header Section.
require get_template_directory() . '/inc/customizer/section-pro/customize-pro.php';
