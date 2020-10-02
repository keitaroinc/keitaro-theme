<?php
/**
 * Template Name: Narrow Page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

get_header();

?>

<div class="container">
	<main id="main" class="site-main" role="main">

		<?php

		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				the_content();

			endwhile;
		else :
			get_template_part( SNIPPETS_DIR . '/content/content-none' );
		endif;

		?>
	</main>
</div>

<?php

get_footer();
