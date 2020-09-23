<?php

/**
 * General template snippet for content
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

	if (has_post_thumbnail()) :
		get_template_part(SNIPPETS_DIR . '/post-thumbnail');
	endif;

	get_template_part(SNIPPETS_DIR . '/header/entry-header');

	if (is_archive() || is_home() || is_search()) :
		get_template_part(SNIPPETS_DIR . '/entry-excerpt');
	else :
		get_template_part(SNIPPETS_DIR . '/entry-content');
	endif;

	comments_template();

	if (is_single()) :

		get_template_part(SNIPPETS_DIR . '/read-next');
		get_template_part(SNIPPETS_DIR . '/entry-footer');

	endif;

	?>
</article>
