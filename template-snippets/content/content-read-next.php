<?php

$get_cats = get_the_terms( get_the_ID(), 'category' );
$get_tags = get_the_terms( get_the_ID(), 'post_tag' );

$post_cats = '';
$post_tags = '';

// Get current post categories
if ( $get_cats ) :
	foreach ( $get_cats as $tag ) :
		$post_cats[] = $tag->term_id;
	endforeach;
endif;

// Get current post tags
if ( $get_tags ) :
	foreach ( get_the_terms( get_the_ID(), 'post_tag' ) as $tag ) :
		$post_tags[] = $tag->term_id;
	endforeach;
endif;

// Get posts that have any of the tags and categories of the current post
$read_more_content = new WP_Query(
	array(
		'post__not_in'   => array( get_the_ID() ),
		'posts_per_page' => 3,
		'tags__in'       => $post_tags,
		'category__in'   => $post_cats,
	)
);

if ( $read_more_content->have_posts() ) :

	?>
	<section class="read-next">
		<div class="row">
			<div class="col-md-10">

				<h3 class="read-next-title"><?php esc_html_e( 'Read next', 'keitaro' ); ?></h3>
				<?php

				while ( $read_more_content->have_posts() ) :

					$read_more_content->the_post();

					?>
					<div class="media">
						<div class="media-left">
							<?php keitaro_author_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
						</div>
						<div class="media-body">
							<?php the_title( '<h4 class="read-more-item-title media-heading"><a href="' . get_permalink() . '">', '</a></h4>' ); ?>
						</div>
					</div>

					<?php

				endwhile;

				?>
			</div>
		</div>
	</section>
		<hr class="visible-xs visible-sm">
	<?php

endif;

// Reset query data to go back to the default WordPress loop
wp_reset_postdata();
