<?php
/**
 * Template snippet for the author of each post
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */
?>

<div class="post-author d-flex align-items-center mb-3">
	<?php
	keitaro_author_avatar( get_the_author_meta( 'ID' ), 40 );

	if ( 'post' === get_post_type() ) :
	?>
		<div class="entry-meta ml-3">
			<?php
			if ( is_singular() || is_archive() || is_home() || is_search() ) :
				keitaro_posted_on();
			endif;
			the_author_posts_link();
			?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
</div>
