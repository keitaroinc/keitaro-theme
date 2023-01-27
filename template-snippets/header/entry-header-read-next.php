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

	if ( ! is_singular( array( 'job-applications', 'showcases' ) ) ) :
		the_category();
	endif;
	the_title( '<h3 class="entry-title h4"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );

	?>
</header>
