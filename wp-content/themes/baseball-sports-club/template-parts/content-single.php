<?php 
 /*
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package baseball-sports-club
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(get_theme_mod('show_metatext_on_off',true) == true ){  ?>
		<div class="entry-meta">
				<?php baseball_sports_club_posted_on();
				baseball_sports_club_entry_meta(); ?>
		</div><!-- .entry-meta -->	
	<?php } ?>
	
	<div class="entry-content sin mt-4">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'baseball-sports-club' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php baseball_sports_club_posts_tags(); ?>
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(						
						esc_html__( 'Edit %s', 'baseball-sports-club' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>	
</article><!-- #post-## -->