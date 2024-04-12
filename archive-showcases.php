<?php

/**
 * Template for all pages, when not overridden
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

get_header();

if ( have_posts() ) :
	$first = true;
?>

	<?php get_template_part( SNIPPETS_DIR . '/header/page-header-with-background' ); ?>

	<div class="container-fluid">

		<div id="primary" class="content-area">

			<div class="row">

				<div class="col-lg-8 offset-lg-2">

					<main id="main" class="site-main" role="main">
						<div class="row row-cols-1 row-cols-lg-3">
							<?php

							while ( have_posts() ) :

								the_post();
								?>
								<div class="col">
									<?php get_template_part( SNIPPETS_DIR . '/content/content-grid' ); ?>
								</div>

							<?php endwhile; ?>
						</div>
					</main>

					<nav class="nav-pagination">
						<?php
						get_template_part( SNIPPETS_DIR . '/navigation/pagination' );
						?>
					</nav>

				</div>

			</div>

			<?php
			get_template_part(
				 SNIPPETS_DIR . '/cta-connect',
				null,
				array(
					'title' => __( 'How may we help you?', 'keitaro' ),
					'button_text' => __(
					"Let's Connect",
						   'keitaro'
				   ),
				)
				);
?>

		<?php

	else :

		get_template_part( SNIPPETS_DIR . '/content/content-none' );

	endif;
		?>

		</div>

	</div>

	<?php

	get_footer();
