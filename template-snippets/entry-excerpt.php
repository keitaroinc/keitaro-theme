<div class="entry-content">
    <?php

	the_excerpt();

	keitaro_read_more( 'btn-success' );

	wp_link_pages( array(
		'before' => '<div class="page-links">' . sprintf( '<h3>%s</h3>', __( 'Page', 'keitaro' ) ),
		'after' => '</div>',
		'link_before' => '<span class="page-number">',
		'link_after' => '</span>',
	) );

	?>
</div><!-- .entry-content -->
