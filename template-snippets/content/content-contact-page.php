<?php
/**
 * Template snippet for the Contact page content
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( SNIPPETS_DIR . '/sidebars/contact-form' ); ?>
</article>
