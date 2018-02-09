<?php
/**
 * Template snippet for the footer of each post
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

// Display author box with relevant meta information
if ( ! is_author() ) :
	keitaro_author_box( get_the_author_meta( 'ID' ) );
endif;

if ( is_single() ) :

	// Display a list of post categories
	if ( get_the_category() ) {
		printf( '<h4>%s</h4>', esc_html__( 'Categories', 'keitaro' ) );
	}
	the_category();

	// Display a list of post tags
	the_tags( sprintf( '<h4>%s</h4>', esc_html__( 'Tags', 'keitaro' ) ) . '<ul class="post-tags"><li>', '</li><li>', '</li></ul>' );

	endif;
