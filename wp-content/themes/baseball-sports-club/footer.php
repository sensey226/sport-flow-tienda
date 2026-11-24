<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package baseball-sports-club
 */

?>

<footer id="colophon" class="site-footer">
    <div class="footer-widgets-area mt-4 container">
    <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="footerbox">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                                <div class="site-branding" style="display: flex;">
                                    <?php $prime_construction_image = get_theme_mod('baseball_sports_club_footer_logo');?>
                                    <?php if($prime_construction_image == ''){?>
                                    <img
                                        src="<?php echo esc_url(get_template_directory_uri()."/assets/images/footer-logo.png");?>">
                                    <?php }else { ?>
                                    <img src="<?php echo esc_url(get_theme_mod('baseball_sports_club_footer_logo'));?>">
                                    <?php } ?>
                                </div>
                                <p class="footer-para py-3">
                                    <?php echo esc_html(get_theme_mod('baseball_sports_club_foot_paragraph', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp or incididunt ut labore et dolore magna aliqua.', 'baseball-sports-club')))?>
                                </p>
                                <div class="footer_social_links">
                                    <a href=""><i
                                            class="fa-brands <?php echo esc_html(get_theme_mod('baseball_sports_club_footfacebook_icon', __('fa-facebook', 'baseball-sports-club'))) ?>"></i></a>
                                    <a href=""><i
                                            class="fa-brands <?php echo esc_html(get_theme_mod('baseball_sports_club_foottwitter_icon', __('fa-twitter', 'baseball-sports-club'))) ?>"></i></a>
                                    <a href=""><i
                                            class="fa-brands <?php echo esc_html(get_theme_mod('baseball_sports_club_footlinkedin_icon', __('fa-linkedin-in', 'baseball-sports-club'))) ?>"></i></a>
                                    <a href=""><i
                                            class="fa-brands <?php echo esc_html(get_theme_mod('baseball_sports_club_footinstagram_icon', __('fa-instagram', 'baseball-sports-club'))) ?>"></i></a>

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-12 footermenu1">
                                <div class="hentry">
                                    <div class="widget_nav_menu">
                                        <h2 class="widget-title">
                                            <?php echo esc_html(get_theme_mod('baseball_sports_club_foot_title1', __('Quick Links', 'baseball-sports-club')))?>
                                        </h2>
                                        <div class="menu-footer">
                                            <ul class="menu m-0 p-0">
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_abtsubmenu1', __('Home', 'baseball-sports-club')))?></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_abtsubmenu2', __('About Us', 'baseball-sports-club')))?></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('prime_onstruction_foot_abtsubmenu3', __('Services', 'baseball-sports-club')))?></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_abtsubmenu4', __('Blog', 'baseball-sports-club')))?></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_abtsubmenu5', __('Contact', 'baseball-sports-club')))?></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-12 footermenu2">
                                <div class="hentry">
                                    <div class="widget_nav_menu">
                                        <h2 class="widget-title">
                                            <?php echo esc_html(get_theme_mod('baseball_sports_club_foot_title2', __('Gallery Widget', 'baseball-sports-club')))?>
                                        </h2>
                                        <div class="menu-footer">
                                            <ul class="menu m-0 p-0">

                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_navsubmenu1', __('About Club', 'baseball-sports-club')))?></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_navsubmenu2', __('Media', 'baseball-sports-club')))?></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_navsubmenu3', __('Donation', 'baseball-sports-club')))?></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_navsubmenu4', __('Pages', 'baseball-sports-club')))?></a>
                                                </li>
                                                <li>
                                                    <a
                                                        href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_navsubmenu5', __('Terms Of Policies', 'baseball-sports-club')))?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                                <div class="hentry">
                                    <div class="widget_nav_menu">
                                        <h2 class="widget-title">
                                            <?php echo esc_html(get_theme_mod('baseball_sports_club_foot_title4', __('SUBSCRIBE & GET THE UPDATED NEWS', 'baseball-sports-club')))?>
                                        </h2>
                                        <div class="menu-footer">                                       
                                        <div class="footer-input"><input type="email" id="email" name="email" placeholder="Enter Email"></div>
                                            <div class="footer-button">
                                                <a href=""><?php echo esc_html(get_theme_mod('baseball_sports_club_foot_buttonText', __('SUBSCRIBE', 'baseball-sports-club')))?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="site-info mt-4">
                        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'baseball-sports-club' ) ); ?>">
                            <?php
							
							printf( esc_html__( 'Proudly powered by %s', 'baseball-sports-club' ), 'WordPress' );
							?>
                        </a>
                        <span class="sep"> | </span>
                        <?php
							
							printf( esc_html__( 'Theme: %1$s by %2$s.', 'baseball-sports-club' ), 'baseball-sports-club', 'Baseball sports Club' );
							?>
                    </div><!-- .site-info -->
                </div>
            </div>
    </div>

    <!-- Scroll to Top Button -->
    <?php if(get_theme_mod('featured_scrooltopbtn_on_off',true) == true ){  ?>
    <div class="scroll-to-top">
        <a href="#" id="scroll-to-top"><i class="fas fa-caret-up"></i></a>
    </div>
    <?php } ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>