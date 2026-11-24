<?php 
/**
 * Template part for displaying Slider Section
 *
 * @package baseball-sports-club
 */

$baseball_sports_club_data_slick_speed = baseball_sports_club_get_option('data_slick_speed');
$baseball_sports_club_data_slick_infinite = baseball_sports_club_get_option('data_slick_infinite');
$baseball_sports_club_data_slick_dots = baseball_sports_club_get_option('data_slick_dots');
$baseball_sports_club_data_slick_autoplay = baseball_sports_club_get_option('data_slick_autoplay');
$baseball_sports_club_data_slick_draggable = baseball_sports_club_get_option('data_slick_draggable');
$baseball_sports_club_data_slick_fade = baseball_sports_club_get_option('data_slick_fade');
$baseball_sports_club_featured_slider_content_type = baseball_sports_club_get_option('featured_slider_content_type');
$baseball_sports_club_number_of_featured_slider_items = baseball_sports_club_get_option('number_of_featured_slider_items');
// $slider_enable_section               = get_theme_mod('slider_enable_section', 'on');

?>
<?php if (!get_theme_mod('slider_enable_section', true)) {
    return;
} ?>

<?php
// Convert numeric options to boolean strings for slick carousel
$baseball_sports_club_data_slick_infinite = $baseball_sports_club_data_slick_infinite ? 'true' : 'false';
$baseball_sports_club_data_slick_dots = $baseball_sports_club_data_slick_dots ? 'true' : 'false';
$baseball_sports_club_data_slick_autoplay = $baseball_sports_club_data_slick_autoplay ? 'true' : 'false';
$baseball_sports_club_data_slick_draggable = $baseball_sports_club_data_slick_draggable ? 'true' : 'false';
$baseball_sports_club_data_slick_fade = $baseball_sports_club_data_slick_fade ? 'true' : 'false';
?>

<div id="featured-slider">
    <div class="section-content"
        data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": <?php echo esc_attr($baseball_sports_club_data_slick_infinite); ?>, "speed": <?php echo esc_attr($baseball_sports_club_data_slick_speed); ?>, "dots": <?php echo esc_attr($baseball_sports_club_data_slick_dots); ?>, "autoplay": <?php echo esc_attr($baseball_sports_club_data_slick_autoplay); ?>, "draggable": <?php echo esc_attr($baseball_sports_club_data_slick_draggable); ?>, "fade": <?php echo esc_attr($baseball_sports_club_data_slick_fade); ?> }'>

        <?php
           $baseball_sports_club_number_of_featured_slider_items = absint( get_theme_mod('number_of_featured_slider_items', 5) ); // Ensure the value is an integer

           // Ensure the number of posts starts from 1, and not showing any extras
           if ($baseball_sports_club_number_of_featured_slider_items < 1) {
               $baseball_sports_club_number_of_featured_slider_items = 1; // Ensure minimum value is 1
           }
        
           ?> <?php $baseball_sports_club_slider_pages = array(); 
			    for ( $baseball_sports_club_count = 1; $baseball_sports_club_count <= 4; $baseball_sports_club_count++ ) {
			        $baseball_sports_club_mod = intval( get_theme_mod( 'select_post_slider'. $baseball_sports_club_count ));
			        if ( 'page-none-selected' != $baseball_sports_club_mod ) {
			          $baseball_sports_club_slider_pages[] = $baseball_sports_club_mod;
			        }
			    }
		      	if( !empty($baseball_sports_club_slider_pages) ) :
			        $baseball_sports_club_args = array(
			          	'post_type' => 'post',
			          	'post__in' => $baseball_sports_club_slider_pages,
                        'posts_per_page' => $baseball_sports_club_number_of_featured_slider_items,
			          	'orderby' => 'post__in'
			        );
		        	$baseball_sports_club_catquery = new WP_Query( $baseball_sports_club_args );
        
           $baseball_sports_club_catquery_counter = 0; // Initialize counter
           while ($baseball_sports_club_catquery->have_posts() && $baseball_sports_club_catquery_counter < $baseball_sports_club_number_of_featured_slider_items) : $baseball_sports_club_catquery->the_post();
           $baseball_sports_club_catquery_counter++;
    ?>
        <article data-post-id="<?php echo esc_attr(get_the_ID()); ?>">
            <div class="opbg">
                <div class="slide-inner slide-bg-image">
                    <div class="sliderimg">
                        <img class="d-block w-100" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>">
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="slider-inner-mainbox">
                            <?php if (get_theme_mod('featured_slider_overlayimg_enable', true)) : ?>
                            <!-- Additional content if enabled -->
                            <?php endif; ?>
                            <div class="container leftcontentbox <?php echo esc_attr(get_theme_mod('baseball_sports_club_featured_slider_onload_effects', 'wow zoomIn')); ?>"
                                data-wow-duration="2s">

                                <div class="wrapper animated <?php echo esc_attr(get_theme_mod('baseball_sports_club_featured_slider_onload_effects','wow Bounce In Up')); ?>"
                                    data-wow-duration="2s">
                                    <div class="entry-container">
                                        <div class="entry-content-div">
                                            <div class="content">
                                                <h2 class="entry-title"
                                                    style="text-transform : <?php if(get_theme_mod('featured_slider_title_case','None') == 'None'){ ?> none <?php } elseif(get_theme_mod('featured_slider_title_case','Lowercase') == 'Lowercase'){ ?> lowercase <?php } elseif(get_theme_mod('featured_slider_title_case','Capitalize') == 'Capitalize'){ ?> capitalize <?php } elseif(get_theme_mod('featured_slider_title_case','Uppercase') == 'Uppercase'){ ?> uppercase <?php } ?>;">
                                                    <?php the_title(); ?></h2>

                                                <div class="entry-content animated flipInY">
                                                    <?php
                                                    $baseball_sports_club_excerpt = baseball_sports_club_the_excerpt( 25 );
                                                    echo wp_kses_post( wpautop( $baseball_sports_club_excerpt ) );
                                                ?>
                                                </div><!-- .entry-content -->

                                                <div class="btn-img mt-3" style="width: max-content;">
                                                    <div class="sliderbut1 animated flipInY d-flex">
                                                        <a href="#"
                                                            class="btn1 btn-custom1 rounded1"><?php echo esc_html(get_theme_mod('baseball_sports_club_button1_text','Get In Touch')); ?></a>
                                                        
                                                    </div>
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .entry-container -->
                                    </div><!-- .wrapper -->
                                </div><!-- .leftcontentbox -->
                            </div><!-- .slider-inner-mainbox -->
                        </div><!-- .row -->
                    </div><!-- .slide-inner -->
                </div><!-- .opbg -->
        </article>
        <?php endwhile; ?>
        <?php endif;?>
        <?php wp_reset_postdata(); ?>
    </div><!-- .section-content -->
</div>