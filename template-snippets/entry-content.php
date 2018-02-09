<?php
/**
 * Template snippet for the content of each post
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<div class="entry-content">
	<?php

		the_content();

	wp_link_pages(
		array(
			'before'      => '<div class="page-links">' . sprintf( '<h3>%s</h3>', __( 'Page', 'keitaro' ) ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		)
		);

	?>
</div><!-- .entry-content -->
