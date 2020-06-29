<?php

/**
 * Template for loading content for the blog page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
	<article class="bg-white frontpage-content pt-5">
	
	<?php
	
	// rest of the posts
	$args = array( 
    'posts_per_page' => 7,
    'post_type'      => 'post',
    'paged'          => get_query_var( 'paged' ),
	);
	// Define our WP Query Parameters
	$the_query = new WP_Query( $args ); ?>
		
  <div class="container">
    <div class="row ">
	<?php 
  // Start our WP Query
  $counter = 0;
	while ($the_query -> have_posts()) : $the_query -> the_post(); 
  // Display the Post Title with Hyperlink
  $counter = $counter +1;
  if($counter == 1):
	?>
				<div class="col-md-9 col-12">
				<?php the_post_thumbnail(); ?>
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<div>
					<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
					<p>By <?php the_author(); ?></p>
					</div>
        </div>
        <div class="col-md-3 text-right"><?php wp_list_categories('orderby=name&title_li=&show_count=1');  ?></div>

  <?php
  else:
    ?>
    <div class="col-md-4 col-12 ">
				<?php the_post_thumbnail(); ?>
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<div>
					<?php keitaro_author_avatar( get_the_author_meta( 'ID' ) );?>
					<p>By <?php the_author(); ?></p>
					</div>
        </div>
    <?php
    endif;
	// Repeat the process and reset once it hits the limit
  endwhile;
  

wp_reset_postdata(); ?>
  
        
			</div>
		</div>
</article>