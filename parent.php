<?php
/**
 * Template for parent pages
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/*
 * Template Name: Parent Page
 */
get_header();

?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php

			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( SNIPPETS_DIR . '/content/content-parent-page' );
					get_template_part( SNIPPETS_DIR . '/content/content-children' );

				endwhile;
			else :
				get_template_part( SNIPPETS_DIR . '/content/content-none' );
			endif;

			?>
		</main>

	</div>
</div>

<?php

get_sidebar();

get_footer();
