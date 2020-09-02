<?php
/**
 * Template for about page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/*
 * Template Name: About Page
 */
get_header();

?>

<div class="container-fluid pl-lg-0">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
          //get_template_part( SNIPPETS_DIR . '/content/content-parent-page' );
          the_content();
				endwhile;
			else :
				get_template_part( SNIPPETS_DIR . '/content/content-none' );
			endif;
			?>
		</main>
	</div>
</div>
<?php
get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-map' );
get_template_part( SNIPPETS_DIR . '/sidebars/business-development' );
?>
<div class="container my-5 pt-5">
<?php
$child_pages = new WP_Query(
  array(
    'post_parent' => get_the_ID(),
    'post_type'   => 'page',
    'order'       => 'ASC',
    'orderby'     => 'menu_order',
    'posts_per_page' => 1,
  )
);

// Loop for the child pages
if ( $child_pages->have_posts() ) :
  while ( $child_pages->have_posts() ) :

    $child_pages->the_post();
    get_template_part( SNIPPETS_DIR . '/content/content-children-no-thumbnail' );
    
  endwhile;
endif;

// Reset query data to go back to the default WordPress loop
wp_reset_postdata();
?>
</div>
<?php
get_template_part( SNIPPETS_DIR . '/sidebars/core-team' );
?>
<div class='bg-white py-5'>
  <div class="container mt-5 pt-5">
      <?php
      $child_pages = new WP_Query(
        array(
          'post_parent' => get_the_ID(),
          'post_type'   => 'page',
          'order'       => 'ASC',
          'orderby'     => 'menu_order',
          'offset' => 1,
        )
      );

      // Loop for the child pages
      if ( $child_pages->have_posts() ) :
        while ( $child_pages->have_posts() ) :

          $child_pages->the_post();
          ?>
          <div class='d-flex justify-content-center my-5'>
          <?php
          the_post_thumbnail();
          ?>
          </div>
          <?php
          get_template_part( SNIPPETS_DIR . '/content/content-children-no-thumbnail' );
          
        endwhile;
      endif;

      // Reset query data to go back to the default WordPress loop
      wp_reset_postdata();
      ?>
  </div>
</div>
<?php
get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );
get_sidebar();

get_footer();
