<?php
/**
 * Template for all pages, when not overridden
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

get_header(); ?>

<main id="main" role="main">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :

			the_post();
			the_content();

		endwhile;
	endif;
	?>

</main>

<?php
get_footer();
