<?php
/**
 * Sections Options
 *
 * @package baseball-sports-club
 */

$wp_customize->add_panel(
        'baseball_sports_club_section_panel',
        [
           'priority' => 130,
           'capability' => 'edit_theme_options',
           'title' => esc_html__('Home Page Section', 'baseball-sports-club'),
        ]
    );

//Section.
require get_template_directory() . '/inc/customizer/home-sections/featured-slider.php';

require get_template_directory() . '/inc/customizer/home-sections/featured-features.php';

require get_template_directory() . '/inc/customizer/home-sections/featured-about.php';
