<?php
/**
 * Sidebar snippet for keitaro_other
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_other';

if ( is_active_sidebar( $sidebar_id ) ) :

	dynamic_sidebar( $sidebar_id );

endif;
