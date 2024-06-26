<?php
/**
 * Template snippet for the content of each child page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-8">

			<header class="entry-header">
				<?php

				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} elseif ( is_front_page() && is_home() ) {
					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}

				?>
			</header><!-- .entry-header -->

			<?php get_template_part( SNIPPETS_DIR . '/entry-content' ); ?>

		</div>
		<div class="col-md-4">
			<?php

			if ( '' !== get_the_post_thumbnail() && ! is_single() ) :
				get_template_part( SNIPPETS_DIR . '/post-thumbnail' );
					endif;

					get_template_part( SNIPPETS_DIR . '/sidebars/page-widgets' );

					keitaro_child_pages_list( get_the_ID() );

			?>
			<?php get_template_part( SNIPPETS_DIR . '/sidebars/icon-blocks' ); ?>
		</div>
	</div>
</article><!-- #post-## -->
