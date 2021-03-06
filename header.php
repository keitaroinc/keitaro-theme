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
			$container_bg_class = 'container-bg';
		endif;

		?>
		<div class="<?php echo esc_html( $container_bg_class ); ?> <?php echo esc_html( $container_wrapper_class ); ?>">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
					<header class="main-navbar content-block">
						<?php get_template_part( SNIPPETS_DIR . '/header/logo' ); ?>
						<?php get_template_part( SNIPPETS_DIR . '/navigation/main-menu' ); ?>
					</header>
				</div>
			</div>
		</div>

		<?php if ( ! is_front_page() ) : ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 col-lg-7 col-lg-offset-1">
					<?php get_template_part( SNIPPETS_DIR . '/navigation/breadcrumb' ); ?>
				</div>
				<?php if ( have_posts() && ! is_page() ) : ?>
					<div class="col-md-4 col-lg-3">
						<?php get_search_form(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
		endif;

		/* Show Hero section only on the front page */
if ( is_front_page() ) :
	get_template_part( SNIPPETS_DIR . '/header/hero' );
		endif;
