<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseball-sports-club
 */

?>

<article class="content-page" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				baseball_sports_club_posted_on();
				baseball_sports_club_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="row">
		<div class="col-lg-6 col-md-6 col-12">
			<div class="image">
				<?php baseball_sports_club_post_thumbnail(); ?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-12">
			<div class="entry-content">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'baseball-sports-club' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'baseball-sports-club' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
