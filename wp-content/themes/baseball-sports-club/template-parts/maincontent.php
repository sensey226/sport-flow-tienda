<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseball-sports-club
 */

?>
<div class="maincontent">
    <div class="post-item">        
        <div class="meta-para mt-4">
            <div class="entry-container">
                <header>
                    <h2 class="page-title mb-0">
                        <?php                       
                        echo '<a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a>';
                        ?>
                    </h2>
                    <div class="entry-meta d-flex">
                        <div>
                            <h4 class="post-date">
                                <i class="fa-regular fa-calendar-days"></i> <a
                                    href="<?php the_permalink();?>"><?php echo esc_html(get_the_date('d M Y')); ?></a>
                            </h4>
                        </div>

                        <div class="post-comment">
                            <i class="fa-regular fa-comment"></i><a href="javascript:void(0);" class="">
                                (<?php echo esc_html(get_comments_number()); ?>) </a>
                        </div>
                    </div><!-- .entry-meta -->
                </header>
                <!-- </?php the_content(); ?> -->
                <p><?php                        
                        $baseball_sports_club_content_limit = 20; 
                        echo wp_trim_words(get_the_content(), $baseball_sports_club_content_limit, '');                        
		            ?></p>

                <div class="button-content">
                    <?php
                echo '<a class="readbtn" href="' . get_permalink() . '">' . __('Read More',
                    'baseball-sports-club') . '</a>';
                    ?>
                </div>


            </div>
        </div>






    </div>

</div>