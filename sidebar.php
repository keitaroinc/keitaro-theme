<?php
/**
 * Template for loading sidebar content
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

// Show Service Icons widget section on the front page
// if ( is_front_page() ) :
// 	get_template_part( SNIPPETS_DIR . '/sidebars/service-icons' );
// endif;

// Show Call to Action widget section on all static pages or the front page
// if ( is_front_page() || is_page() ) :
// 	get_template_part( SNIPPETS_DIR . '/sidebars/call-to-action' );
// endif;

// Show  the latest four posts on the frontpage
if ( is_front_page() ) :
get_template_part( SNIPPETS_DIR . '/frontpage-content' );
endif;

