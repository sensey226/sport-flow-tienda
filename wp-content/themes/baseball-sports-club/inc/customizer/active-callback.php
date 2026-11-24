<?php
/**
 * Active callback functions.
 *
 * @package baseball-sports-club
 */

function baseball_sports_club_featured_slider_active( $control ) {
    if( $control->manager->get_setting( 'slider_enable_section' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}
function baseball_sports_club_featured_slider_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[featured_slider_content_type]' )->value();
    return ( baseball_sports_club_featured_slider_active( $control ) && ( 'featured_slider_page' == $content_type ) );
}

//  About

function baseball_sports_club_featured_about_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[enable_featured_about_section]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}
function baseball_sports_club_featured_about_page( $control ) {
    $content_type = $control->manager->get_setting( 'theme_options[featured_about_content_type]' )->value();
    return ( baseball_sports_club_featured_about_active( $control ) && ( 'featured_about_page' == $content_type ) );
}

function baseball_sports_club_featured_services_post() {
    return is_single(); 
}

/**
 * Active Callback for top bar section
 */
function baseball_sports_club_contact_info_ac( $control ) {

    $show_contact_info = $control->manager->get_setting( 'theme_options[show_header_contact_info]')->value();
    $control_id        = $control->id;
         
    if ( $control_id == 'theme_options[header_location]' && $show_contact_info ) return true;
    if ( $control_id == 'theme_options[header_email]' && $show_contact_info ) return true;
    if ( $control_id == 'theme_options[header_phone]' && $show_contact_info ) return true;
    if ( $control_id == 'theme_options[hphone_text]' && $show_contact_info ) return true;

    return false;
}

function baseball_sports_club_social_links_active( $control ) {
    if( $control->manager->get_setting( 'theme_options[show_header_social_links]' )->value() == true ) {
        return true;
    }else{
        return false;
    }
}