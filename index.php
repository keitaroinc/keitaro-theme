<?php get_header(); ?>

<div class="container">

	<?php if (!is_front_page()) : ?>
		<?php

		if (!is_404()):
			get_search_form();
		endif;

		?>
		<div id="primary" class="content-area">
				<?php get_template_part(SNIPPETS_DIR . '/header/page', 'header'); ?>
			<main id="main" class="site-main" role="main">

				<?php

				if (have_posts()) :
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						if (is_page()) :
							get_template_part(SNIPPETS_DIR . '/content/content', 'page');
						else :
							get_template_part(SNIPPETS_DIR . '/content/content');
						endif;

					endwhile;

				else :
					get_template_part(SNIPPETS_DIR . '/content/content', 'none');
				endif;

				echo paginate_links(array(
					'mid_size' => 6,
					'type' => 'list',
				));

				?>
			</main>

		</div>
<?php endif; ?>
<?php get_sidebar(); ?>
</div>

<?php

get_footer();
