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

if (have_posts()) :
?>
	<div class="container-fluid">
		<div id="primary" class="content-area">
			<?php get_template_part(SNIPPETS_DIR . '/header/page-header'); ?>
			<main id="main" class="site-main" role="main">
				<?php

				while (have_posts()) :

					the_post();
					if (is_page()) :
						get_template_part(SNIPPETS_DIR . '/content/content-page');
					else :
						get_template_part(SNIPPETS_DIR . '/content/content');
					endif;

				endwhile;

				?>
			</main>

		<?php

	else :

		get_template_part(SNIPPETS_DIR . '/content/content-none');

	endif;

	if ($paged && (!is_author() && !is_404())) :

		?>

			<div class="row">
				<div class="col-md-8 offset-md-2">
					<?php get_template_part(SNIPPETS_DIR . '/navigation/pagination'); ?>
				</div>
			</div>

		<?php

	else :
		?>
			<div class="row">
				<div class="col-md-8 offset-md-2">
					<?php
					get_template_part(SNIPPETS_DIR . '/navigation/pagination');
					?>
				</div>
			</div>
		<?php
	endif;

		?>

		</div>

	</div>

	<?php

	get_footer();
