<header class="entry-header">
    <?php

	if ( is_sticky() && ! is_single() ) :
		printf( '<p class="sticky-title-sm">%s</p>', __( 'Must read', 'keitaro' ) );
	endif;

	if ( is_singular() ) :
		the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
	elseif ( is_front_page() && is_home() ) :
		the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
	elseif ( is_sticky() ) :
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	else :
		the_title( '<h2 class="entry-title h3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif;

	if ( 'post' === get_post_type() ) :
		echo '<div class="entry-meta">';
		if ( is_single() || is_archive() || is_home() ) :
			keitaro_posted_on();
		endif;
		echo '</div><!-- .entry-meta -->';
	endif;

	?>
</header>
