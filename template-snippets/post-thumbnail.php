<?php

/**
 * Template snippet for the thumbnail of each post
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

if ( is_single() ) :
	$thumbnail_size = 'full';
else :
	$thumbnail_size = 'large';
endif;

$thumbnail_caption = esc_html( get_the_post_thumbnail_caption() );

?>
<figure class="post-thumbnail">
	<a href="<?php ( is_attachment() ? the_post_thumbnail_url() : the_permalink() ); ?>">
		<?php
		the_post_thumbnail(
			 $thumbnail_size,
			array(
				'class' => 'img-fluid',
				'decoding' => 'async',
			)
			);
?>
	</a>
	<?php

	if ( $thumbnail_caption ) :
		printf( '<figcaption>%s</figcaption>', wp_kses_post( $thumbnail_caption ) );
	endif

	?>
</figure>
