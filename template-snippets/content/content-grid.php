<?php

/**
 * General template snippet for grid content
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('hentry-grid'); ?>>
	<?php

	if (has_post_thumbnail()) :
		get_template_part(SNIPPETS_DIR . '/post-thumbnail');
	endif;

	get_template_part(SNIPPETS_DIR . '/header/entry-header');

	get_template_part(SNIPPETS_DIR . '/post-author');

	?>
</article>
