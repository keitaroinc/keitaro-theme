<?php

/**
 * Template for loading content for the sidebar
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
	<article class="bg-white frontpage-content pt-5">
	<?php 
	// Define our WP Query Parameters
	// first post
		$the_query = new WP_Query( 'posts_per_page=1' ); ?>

    <h1 class="text-center pt-5 mb-2"> <a href="<?php the_permalink(14); ?>"><?php echo get_the_title(14); ?></a></h1>
			
		<div class="container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="row">
		<?php 
	// Start our WP Query
			while ($the_query -> have_posts()) : $the_query -> the_post(); 
		?>

				<div class="col-12 my-5">
					<div class="row  d-flex align-items-center">
						<div class="col-md-8 col-12" style="display:inline-block">
							<?php the_post_thumbnail(); ?> 
						</div>
					<div class="col-md-4 col-12" style="display:inline-block">
						<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
						<p>
						<?php
				// Display the Post Excerpt
						the_excerpt(__('(more…)')); ?></p>
						<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
						<p>By <?php the_author(); ?></p>
				</div>
				</div>
				</div>
		
	<?php 
	// Repeat the process and reset once it hits the limit
	endwhile;
	wp_reset_postdata();
	?>
		</div>
	</div>
	<?php
	
	// rest of the posts
	$args = array( 
		'posts_per_page' => 3,
		'offset' =>1,
	);
	// Define our WP Query Parameters
	$the_query = new WP_Query( $args ); ?>
		
		
		<div class="container">
		<div class="row ">
	<?php 
	// Start our WP Query
	while ($the_query -> have_posts()) : $the_query -> the_post(); 
	// Display the Post Title with Hyperlink
	?>
	
				<div class="col-md-4 col-12">
				<?php the_post_thumbnail(); ?>
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<div>
					<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
					<p>By <?php the_author(); ?></p>
					</div>
				</div>
		

	<?php 
	// Repeat the process and reset once it hits the limit
	endwhile;
	wp_reset_postdata();
	?>
			</div>
		</div>
</article>