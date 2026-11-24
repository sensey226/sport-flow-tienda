<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package baseball-sports-club
 */

get_header();
?>

<main id="primary" class="site-main singlepage">
    <div class="banner-head"></div>
    <div class="blog-div container-fluid p-5" id="primaryid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header pt-5">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        <div class="archive-info mb-3">
                            <span class="date"><?php esc_html_e('Published on:', 'baseball-sports-club'); ?>
                                <?php the_time('F j, Y'); ?></span>
                            <span class="author"><?php esc_html_e('by', 'baseball-sports-club'); ?>
                                <?php the_author(); ?></span>

                        </div>
                    </header>
                    <div class="row">
                        <div class="entry-content col-lg-9 col-md-8 col-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <?php								
								echo get_the_content();
								?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 position-relative">
                                    <span class="categories"><?php esc_html_e('Cat:', 'baseball-sports-club'); ?>
                                        <?php the_category(', '); ?></span>

                                    <?php
									if (has_post_thumbnail()) {
									the_post_thumbnail('full'); 
									}
								?>
                                </div>
                            </div>

                            <div class="pt-3">
                                <?php
								while ( have_posts() ) :
									the_post();								
										
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										endif;

									endwhile; 
							?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-12 single_sidebar">
                            <?php							  
								  if ( have_posts() ) :
									while ( have_posts() ) : the_post();
									  endwhile;
								 endif;								
							if ( is_active_sidebar( 'sidebar-1' ) ) {
								 dynamic_sidebar( 'sidebar-1' );								
							}
							 ?>
                        </div>
                    </div>
            </div>
        </div>
        <?php
			the_post_navigation(
					  array(
								 'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'baseball-sports-club' ) . '</span> <span class="">%title</span>',
								 'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'baseball-sports-club' ) . '</span> <span class="">%title</span>',
						)
		);
	?>
    </div>


    <footer class="entry-footer">
        <?php
					  
					?>
    </footer>
    </article><!-- #post-<?php the_ID(); ?> -->

    </div>
    </div>

</main><!-- #main -->


<?php
get_footer();