<div class="entry-content">
    <?php
	/* translators: %s: Name of current post */
	echo apply_filters( 'the_excerpt', get_the_excerpt() );
    
    keitaro_read_more();

	wp_link_pages(array(
		'before' => '<div class="page-links">' . sprintf( '<h3>%s</h3>', __( 'Page', 'twentyseventeen' ) ),
		'after' => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after' => '</span>',
	));
	?>
</div><!-- .entry-content -->
