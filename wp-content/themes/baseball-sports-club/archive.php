<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package baseball-sports-club
 */

get_header();
?>

<main id="primary" class="site-main archivepage">
<div class="banner-head"></div>
<div class="blog-div container-fluid arc p-5" id="primaryid">
	<div class="row">
		<div class="col-lg-9 col-md-9 col-12 archive-col">
			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
			</header><!-- .page-header -->

			<?php
		
		while ( have_posts() ) :
			the_post();
			?>
			<div class="mainrow mb-3">

				<?php  get_template_part( 'template-parts/content', get_post_type() ); ?>

			</div>
			<?php
			
			
		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>
		</div>
		<div class="col-lg-3 col-md-3 col-12 mt-5">
			<div class="sidebar-div">
				<?php 					
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();

						endwhile;
					endif;
					if ( is_active_sidebar( 'sidebar-1' ) ) {
						dynamic_sidebar( 'sidebar-1' );
					} else {
						get_sidebar();
					}
					?>
			</div>
		</div>
	</div>
</div>

</main><!-- #main -->

<?php
get_footer();
