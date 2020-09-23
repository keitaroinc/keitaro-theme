<?php

/**
 * General template snippet for Single content
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row">
		<div class="col-lg-10 offset-lg-1">
			<?php

			get_template_part(SNIPPETS_DIR . '/post-author');
			get_template_part(SNIPPETS_DIR . '/header/entry-header');

			?>
		</div>
	</div>

	<?php if (has_post_thumbnail()) :
		get_template_part(SNIPPETS_DIR . '/post-thumbnail');
	endif; ?>

	<div class="row">
		<div class="col-lg-10 offset-lg-1">
			<?php if (is_archive() || is_home() || is_search()) :
				get_template_part(SNIPPETS_DIR . '/entry-excerpt');
			else :
				get_template_part(SNIPPETS_DIR . '/entry-content');
			endif;

			comments_template();

			?>
		</div>
	</div>

	<?php get_template_part(SNIPPETS_DIR . '/read-next'); ?>
</article>
