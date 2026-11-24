<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package baseball-sports-club
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title mt-4"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'baseball-sports-club' ); ?></h1>
				</header><!-- .page-header -->
				<span class="error-404title"><?php esc_html_e( '404', 'baseball-sports-club' ); ?></span>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'baseball-sports-club' ); ?></p>

						<?php
						get_search_form();
						?>
				</div><!-- .page-content -->
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
