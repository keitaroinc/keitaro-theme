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
	$post_type = get_post_type( get_the_ID() );

	if ( has_post_thumbnail() ) :
		get_template_part( SNIPPETS_DIR . '/post-thumbnail' );
	endif;

	get_template_part( SNIPPETS_DIR . '/header/entry-header-read-next' );
	
	if ($post_type!== 'job-applications' && $post_type !== 'showcases'):
		get_template_part( SNIPPETS_DIR . '/post-author' );
	endif;

	?>
</article>
</div>
