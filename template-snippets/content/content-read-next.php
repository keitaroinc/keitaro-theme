<?php
/**
 * Template snippet for Read Next content
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<div class="col-lg-4">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

	if ( has_post_thumbnail() ) :
		get_template_part( SNIPPETS_DIR . '/post-thumbnail' );
	endif;

	get_template_part( SNIPPETS_DIR . '/header/entry-header-read-next' );

	if ( ! is_singular( array( 'showcases' ) ) ) :
		get_template_part( SNIPPETS_DIR . '/post-author' );
	endif;

	?>
</article>
</div>
