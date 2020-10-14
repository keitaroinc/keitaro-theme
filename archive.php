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
	<div class="container-fluid">

		<div id="primary" class="content-area">

			<?php get_template_part( SNIPPETS_DIR . '/header/page-header' ); ?>

			<div class="row">

				<div class="col-lg-10 offset-lg-1">

					<main id="main" class="site-main" role="main">
						<div class="row">
							<?php

							while ( have_posts() ) :

								the_post();
								if ( $first ) {
								?>

									<div class="col-lg-12">
										<div class="row mb-5">
											<div class="col-lg-8">
												<?php get_template_part( SNIPPETS_DIR . '/content/content-first' ); ?>
											</div>
											<div class="col-lg-4">
												<?php get_sidebar(); ?>
											</div>
										</div>
									</div>

									<?php $first = false; ?>
								<?php
								} else {
								?>
									<div class="col-lg-4">
										<?php get_template_part( SNIPPETS_DIR . '/content/content-grid' ); ?>
									</div>
							<?php
							}

							endwhile;

							?>
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

	else :

		get_template_part( SNIPPETS_DIR . '/content/content-none' );

	endif;
		?>

		</div>

	</div>

	<?php

	get_footer();
