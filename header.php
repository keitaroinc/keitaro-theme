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

		if ( is_front_page() ) :
			$container_class = 'container';
		else :
			$container_class = 'container-fluid';
		endif;

		?>
		<div class="container-bg">
			<div class="<?php echo $container_class; ?>">
				<header class="main-navbar content-block">
                    <div class="pull-left">
							<?php get_template_part( SNIPPETS_DIR . '/header/logo' ); ?>
                    </div>
                    <div class="pull-right">
							<?php get_template_part( SNIPPETS_DIR . '/navigation/main-menu' ); ?>
					</div>
				</header>
			</div>
		</div>
		<?php

		get_template_part( SNIPPETS_DIR . '/navigation/breadcrumb' );

		// Show Hero section only on the front page
		if ( is_front_page() ) :
			get_template_part( SNIPPETS_DIR . '/header/hero' );
		endif;
