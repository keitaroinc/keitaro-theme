<?php
/**
 * Template snippet for the content of each parent page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<?php if ( get_the_content() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php

		get_template_part( SNIPPETS_DIR . '/header/entry-header' );
		get_template_part( SNIPPETS_DIR . '/entry-content' );

		?>
	</article>
	<?php
endif;
