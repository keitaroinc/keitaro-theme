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
	<section class="read-next">
		<h2 class="read-next-title text-center has-text-align-center"><?php esc_html_e( 'Read Next', 'keitaro' ); ?></h2>
		<div class="row">
			<?php

			while ( $read_more_content->have_posts() ) :

				$read_more_content->the_post();

				get_template_part( SNIPPETS_DIR . '/content/content-read-next' );

			endwhile;

			?>
		</div>
	</section>
<?php

endif;

// Reset query data to go back to the default WordPress loop
wp_reset_postdata();
