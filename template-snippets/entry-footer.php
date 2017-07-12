<?php

// Display author box with relevant meta information
if ( ! is_author() ) :
	keitaro_author_box( get_queried_object_id() );
endif;

if ( is_single() ) :

// Display a list of post categories
	if ( get_the_category() ) {
		printf( '<h4>%s</h4>', __( 'Categories', 'keitaro' ) );
	}
	the_category();

// Display a list of post tags
	the_tags( sprintf( '<h4>%s</h4>', __( 'Tags', 'keitaro' ) ) . '<ul class="post-tags"><li>', '</li><li>', '</li></ul>' );

	endif;
