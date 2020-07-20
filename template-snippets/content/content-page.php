<?php

/**
 * Template snippet for the content of each page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="">
		<div class="col-lg-12">
			<?php

			get_template_part( SNIPPETS_DIR . '/header/entry-header' );

			get_template_part( SNIPPETS_DIR . '/entry-content' );

			?>
		</div>
		<div class="col-lg-4">
			<?php

			if ( '' !== get_the_post_thumbnail() && ! is_single() ) :
				get_template_part( SNIPPETS_DIR . '/post-thumbnail' );
			endif;

			get_template_part( SNIPPETS_DIR . '/sidebars/page-widgets' );

			keitaro_child_pages_list( get_the_ID() );

			get_template_part( SNIPPETS_DIR . '/sidebars/icon-blocks' );

			?>
		</div>
	</div>
</article>
