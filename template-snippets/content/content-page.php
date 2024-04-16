<?php
/**
 * Template snippet for the content of each page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'my-5' ); ?>>
	<?php

	get_template_part( SNIPPETS_DIR . '/header/entry-header' );

	if ( '' !== get_the_post_thumbnail() && ! is_single() ) :
		get_template_part( SNIPPETS_DIR . '/post-thumbnail' );
	endif;

	get_template_part( SNIPPETS_DIR . '/entry-content' );

	?>
</article>
