<?php
/**
 * Sidebar snippet for keitaro_get_quote
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_get_quote';

if ( is_active_sidebar( $sidebar_id ) ) :

	dynamic_sidebar( $sidebar_id );

endif;
