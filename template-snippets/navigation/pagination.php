<?php
/**
 * Template snippet for pagination navigation
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

echo wp_kses_post( paginate_links( array(
	'mid_size' => 6,
	'type' => 'list',
) ) );
