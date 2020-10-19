<?php

/**
 * Template snippet for the header of each post
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<header class="entry-header">
	<?php

$post_type = get_post_type( get_the_ID() );
if ($post_type!== 'job-applications' && $post_type !== 'showcases'):
	the_category();
endif;
	the_title( '<h3 class="entry-title h4"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

	?>
</header>
