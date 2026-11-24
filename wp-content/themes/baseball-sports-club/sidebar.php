<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package baseball-sports-club
 */

?>

<aside id="secondary" class="widget-area sidebar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

<?php 
  if ( ! is_active_sidebar( 'sidebar-1' )) { ?>
<aside id="secondary" class="widget-area">
    <section id="Search" class="widget widget_block widget_archive ">
        <h2 class="widget-title" style="text-transform : <?php if(get_theme_mod('sidebar_headingtext_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } elseif(get_theme_mod('sidebar_headingtext_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('sidebar_headingtext_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('sidebar_headingtext_case','None') == 'None'){ ?> none <?php } ?> "><?php esc_html_e('Search', 'baseball-sports-club'); ?></h2>
        <?php get_search_form(); ?>
    </section>
    <section id="recent-posts" class="widget" role="complementary">
        <h2 class="widget-title" style="text-transform : <?php if(get_theme_mod('sidebar_headingtext_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } elseif(get_theme_mod('sidebar_headingtext_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('sidebar_headingtext_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('sidebar_headingtext_case','None') == 'None'){ ?> none <?php } ?> "><?php esc_html_e('Recent Posts', 'baseball-sports-club'); ?></h2>
        <ul class="recent-posts-list">
            <?php
		        $baseball_sports_club_recent_posts = get_posts(array(
		            'numberposts' => 5, 
		            'post_status' => 'publish',
		        ));

		        foreach ($baseball_sports_club_recent_posts as $baseball_sports_club_post) :
		            setup_postdata($baseball_sports_club_post);
		            ?>
            <li>
                <a href="<?php echo get_permalink($baseball_sports_club_post->ID); ?>">
                    <?php echo esc_html(get_the_title($baseball_sports_club_post->ID)); ?>
                </a>
            </li>
            <?php
		        endforeach;
		        wp_reset_postdata();
		        ?>
        </ul>
    </section>
    <section id="archives" class="widget widget_block widget_archive ">
        <h2 class="widget-title" style="text-transform : <?php if(get_theme_mod('sidebar_headingtext_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } elseif(get_theme_mod('sidebar_headingtext_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('sidebar_headingtext_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('sidebar_headingtext_case','None') == 'None'){ ?> none <?php } ?> "><?php esc_html_e('Archives', 'baseball-sports-club'); ?></h2>
        <ul>
            <?php
		        wp_get_archives(array(
		            'type'            => 'monthly',
		            'show_post_count' => true,
		        ));
		        ?>
        </ul>
    </section>
    <section id="categories" class="widget widget_categories" role="complementary">
        <h2 class="widget-title" style="text-transform : <?php if(get_theme_mod('sidebar_headingtext_case','Capitalize') == 'Capitalize'){ ?> Capitalize <?php } elseif(get_theme_mod('sidebar_headingtext_case','Uppercase') == 'Uppercase'){ ?> Uppercase <?php } elseif(get_theme_mod('sidebar_headingtext_case','Lowercase') == 'Lowercase'){ ?> Lowercase <?php } elseif(get_theme_mod('sidebar_headingtext_case','None') == 'None'){ ?> none <?php } ?> "><?php esc_html_e('Categories', 'baseball-sports-club'); ?></h2>
        <ul>
            <?php
		        wp_list_categories(array(
		            'orderby'    => 'name',
		            'title_li'   => '',
		            'show_count' => true,
		        ));
		        ?>
        </ul>
    </section>


</aside><!-- #secondary -->
<?php } ?>
