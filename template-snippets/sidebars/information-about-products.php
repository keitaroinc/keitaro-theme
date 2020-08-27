<?php
/**
 * Sidebar snippet for keitaro_information_about_products
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_information_about_products';

if ( is_active_sidebar( $sidebar_id ) ) :

	dynamic_sidebar( $sidebar_id );

endif;
