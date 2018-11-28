<?php
/**
 * Template for parent pages
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/*
 * Template Name: Parent Page
 */
get_header();

?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php

			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( SNIPPETS_DIR . '/content/content-parent-page' );

					$child_pages = new WP_Query(
						array(
							'post_parent' => get_the_ID(),
							'post_type'   => 'page',
							'order'       => 'ASC',
							'orderby'     => 'menu_order',
						)
					);

					// Loop for the child pages
					if ( $child_pages->have_posts() ) :
						while ( $child_pages->have_posts() ) :

							$child_pages->the_post();
							$show_widget = false;

							$icon_blocks = get_option( 'widget_widget_keitaro_icon_block' );

							foreach ( $icon_blocks as $item ) :
								if ( is_array( $item ) && in_array( get_the_ID(), $item ) ) :
									$show_widget = true;
								endif;
							endforeach;

							if ( has_post_thumbnail() || $show_widget ) :
								get_template_part( SNIPPETS_DIR . '/content/content-children' );
							else :
								get_template_part( SNIPPETS_DIR . '/content/content-children-no-thumbnail' );
							endif;

						endwhile;
					endif;

					// Reset query data to go back to the default WordPress loop
					wp_reset_postdata();

				endwhile;
			else :
				get_template_part( SNIPPETS_DIR . '/content/content-none' );
			endif;

			?>
		</main>

	</div>
</div>

<?php

get_sidebar();

get_footer();
