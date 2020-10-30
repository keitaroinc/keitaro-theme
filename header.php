<?php
/**
 * Template for displaying the header
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php

		$container_wrapper_class = 'container-fluid';
		$container_bg_class      = '';

		if ( ! is_front_page() ) :
			$container_bg_class = 'container-bg container-bottom-border';
		endif;

		?>
		<div class="<?php echo esc_html( $container_bg_class ); ?> <?php echo esc_html( $container_wrapper_class ); ?>">
		<div class="row">
			<div class="col-xl-10 offset-xl-1">
					<nav class="navbar navbar-expand-xl navbar-light">
						<?php get_template_part( SNIPPETS_DIR . '/header/logo' ); ?>
						<?php get_template_part( SNIPPETS_DIR . '/navigation/main-menu' ); ?>
					</nav>
				</div>
			</div>
		</div>

		<?php
		if ( ! is_front_page() ) :
		?>
		<div class="container-fluid navbar-breadcrumbs">
			<div class="row">
				<div class="col-xl-10 offset-xl-1">
					<?php get_template_part( SNIPPETS_DIR . '/navigation/breadcrumb' ); ?>
				</div>
			</div>
		</div>
		<?php
		endif;
