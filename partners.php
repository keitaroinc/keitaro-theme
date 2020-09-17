<?php
/**
 * Template for partners page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/*
 * Template Name: Partners Page
 */
get_header();

?>

<div class="showcases-header d-flex flex-column">
<div class="showcases-content">
<?php the_content(); ?>
</div>
<?php
the_post_thumbnail();
?>
</div>
<?php
get_template_part( SNIPPETS_DIR . '/sidebars/partners' );
?>
<div class="container-fluid partners-content px-xl-0 pb-5 mb-5">
	  <?php
	$child_pages = new WP_Query(
		array(
			'post_parent' => get_the_ID(),
			'post_type'   => 'page',
			'order'       => 'ASC',
			'orderby'     => 'menu_order',
		)
	  );

	  // Loop for the child pages
	  if ( $child_pages->have_posts() ) :
			while ( $child_pages->have_posts() ) :

			  $child_pages->the_post();
			  ?>
		  <div class='my-5 py-5'>
				<?php
				the_content();
				?>
		   </div> 
			  <?php
				endwhile;
	  endif;

	  // Reset query data to go back to the default WordPress loop
	  wp_reset_postdata();
	  ?>
  </div>
<?php
get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );

get_footer();
