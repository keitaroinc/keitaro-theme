<?php
/**
 * Template Name: About
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 *
 */

get_header();

the_content();

get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-map' );
get_template_part( SNIPPETS_DIR . '/sidebars/business-development' );
get_template_part( SNIPPETS_DIR . '/sidebars/core-team' );
get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );
get_sidebar();

get_footer();
