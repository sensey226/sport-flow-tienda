<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package baseball-sports-club
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site header">
        <a class="skip-link screen-reader-text"
            href="#primaryid"><?php esc_html_e( 'Skip to content', 'baseball-sports-club' ); ?></a>
        <header id="masthead" class="site-header">
            <div id="section-header" class="section-header">
                <div class="bottomheader stickyheader <?php echo esc_attr(baseball_sports_club_sticky_header()); ?>">
                    <div class="container"
                        style="<?php if ( get_header_image() ) : ?>background-image: url('<?php echo esc_url( get_header_image() ); ?>');<?php endif; ?>background-position: center top;background-size: cover;">
                        <div class="row header-row">
                            <nav id="site-navigation" class="main-navigation navbar navbar-expand-lg">
                                <div class="col-xl-3 col-lg-3 col-md-12 col-12">
                                    <div class="sitenave">
                                        <div class="site-branding">
                                            <?php
                                        if (has_custom_logo()) {
                                            the_custom_logo();
                                        } else {
                                            if (is_front_page() && is_home()): ?>
                                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                    rel="home"><?php bloginfo('name'); ?></a></h1>
                                            <?php else: ?>
                                            <div class="business-box">
                                                <div class="business-title-container">
                                                    <h1 class="site-title"><a
                                                            href="<?php echo esc_url(home_url('/')); ?>"
                                                            rel="home"><?php bloginfo('name'); ?></a></h1>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <?php
                                        $the_baseball_sports_club_description = get_bloginfo('description', 'display');
                                        if ($the_baseball_sports_club_description || is_customize_preview()): ?>
                                            <p class="site-description">
                                                <?php echo $the_baseball_sports_club_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                            </p>
                                            <?php endif; 
                                    } ?>
                                        </div>
                                        <button class="menu-toggle mt-2" aria-controls="primary-menu" aria-expanded="false">
                                            <i class="fa-solid fa-bars mobile-nav-icon bars"></i>
                                            <i class="fa-solid fa-xmark mobile-nav-icon close"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-8 nav-container">
                                    <div class="header-nav">
                                        <div class="row">
                                            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-8">
                                                <?php
                                                    wp_nav_menu(
                                                        array(
                                                            'theme_location' => 'menu-1',
                                                            'menu_id'        => 'primary-menu',
                                                        )
                                                    );
                                                ?>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-12 col-sm-8">
                                                <div class="social-links">
                                                    <i
                                                        class="fa-solid socialicon <?php echo esc_html(get_theme_mod('baseball_sports_club_call_icon', __('fa-phone-volume', 'baseball-sports-club'))) ?>"></i>
                                                    <p><?php echo esc_html(get_theme_mod('baseball_sports_club_head_calltitle', __('+012 3456 789', 'baseball-sports-club'))) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav><!-- #site-navigation -->
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- #masthead -->