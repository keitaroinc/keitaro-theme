<?php

if ( is_single() ) :
	$thumbnail_size = 'large';
else :
	$thumbnail_size = 'thumbnail';
endif;

?>
<div class="post-thumbnail">
	<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( $thumbnail_size ); ?>
	</a>
</div>
