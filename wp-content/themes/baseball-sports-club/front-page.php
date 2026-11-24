<?php
get_header();

if (is_front_page() && is_home()) { ?>
<?php
    /**
     * Template Name: Custom Front Page
     */

get_header(); ?>
<main id="primary" class="site-main front">   
    <?php 
        $baseball_sports_club_header_image1 = get_theme_mod('baseball_sports_club_header_image1');                    
        if(!empty($baseball_sports_club_header_image1)) {  ?>
    <div class="banner-head" style="background-image: url('<?php echo esc_url($baseball_sports_club_header_image1)?>');">
        <div class="center-div">
            <h1><?php esc_html_e('Posts', 'baseball-sports-club'); ?></h1>
        </div>
    </div>;
    <?php } else{?>
    <div class="banner-head"
        style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/slider2.png' ); ?>');">
        
        <div class="center-div">
            <h1><?php esc_html_e('Posts', 'baseball-sports-club'); ?></h1>
        </div>
    </div>;
    <?php }?>
    <div class="blog-div container p-2 mt-3" id="primaryid">       
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12 front-post">
                    <?php
                    if (have_posts()) :

                        if (is_home() && !is_front_page()) :
                            ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                    <?php
                endif;?>
                    <div class="row mainrow">
                        <?php
                        while (have_posts()) :
                            the_post();
                            ?>

                        <div class="col-lg-6 col-md-6 col-12 box gap-10">
                            <?php
                            get_template_part( 'template-parts/maincontent', get_post_type() );
                        ?>
                        </div>

                        <?php
                            		
                          endwhile;
                          the_posts_pagination(array(
                            'mid_size'  => __('2', 'baseball-sports-club'),
                            'prev_text' => __('« Previous', 'baseball-sports-club'),
                            'next_text' => __('Next »', 'baseball-sports-club'),
                          ));
                    
                    else :

                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 sidebar-col ">
                    <div class="sidebar-div mx-3">
                        <?php
                        if (is_active_sidebar('sidebar-1')) {
                            dynamic_sidebar('sidebar-1');
                        } else {
                            get_sidebar();
                        }
                        ?>
                    </div>
                </div>
            </div>
       

    </div>
</main>

<?php get_footer(); ?>

<?php } elseif (is_front_page() && !is_home()) { ?>
<main id="primary" class="site-main">
    <?php
        get_template_part('template-parts/section/section', 'featured-slider');

        get_template_part('template-parts/section/section', 'featured-features');

        get_template_part('template-parts/section/section', 'featured-about');
        ?>
</main><!-- #main -->
<?php }

get_footer();
?>