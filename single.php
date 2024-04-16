<?php
/**
 * Template for all posts, when not overridden
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

				<div class="col-lg-8 offset-lg-2">

					<main id="main" class="site-main" role="main">
						<?php

						while ( have_posts() ) :

							the_post();
							get_template_part( SNIPPETS_DIR . '/content/content-single' );

						endwhile;

						?>
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
