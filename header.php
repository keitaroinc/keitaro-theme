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
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window,document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '333917168023679'); 
		fbq('track', 'PageView');
		</script>
		<noscript>
		<img height="1" width="1" 
		src="https://www.facebook.com/tr?id=333917168023679&ev=PageView
		&noscript=1"/>
		</noscript>
<!-- End Facebook Pixel Code -->
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
