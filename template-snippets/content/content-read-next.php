<?php

$get_cats = get_the_terms( get_the_ID(), 'category' );
$get_tags = get_the_terms( get_the_ID(), 'post_tag' );

$post_cats = array();
$post_tags = array();

// Get current post categories
if ( $get_cats ) :
	foreach ( $get_cats as $tag ) :
		array_push( $post_cats, $tag->term_id );
	endforeach;
endif;

// Get current post tags
if ( $get_tags ) :
	foreach ( get_the_terms( get_the_ID(), 'post_tag' ) as $tag ) :
		array_push( $post_tags, $tag->term_id );
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
	<section class="read-next mt-5">
		<div class="row mt-5">
				<div class="col-12">	
				<h2 class="read-next-title entry-title text-center"><?php esc_html_e( 'Read next', 'keitaro' ); ?></h2>
				</div>
				<?php

				while ( $read_more_content->have_posts() ) :

					$read_more_content->the_post();

					?>
					<div class="col-md-4 col-12 d-flex flex-column">
					<div class="align-items-center my-2">
					<?php the_post_thumbnail(); ?>
						<div class="media-body">
							<?php the_title( '<h4 class="read-more-item-title media-heading"><a href="' . get_permalink() . '">', '</a></h4>' ); ?>
							<div class="blogs-content-categories">
							<?php
														the_category();
														?>
														</div>
							<?php keitaro_author_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
						</div>
					</div>
					</div>
					<?php

				endwhile;

				?>

		</div>
	</section>
		<hr class="visible-xs visible-sm">
	<?php

endif;

// Reset query data to go back to the default WordPress loop
wp_reset_postdata();
