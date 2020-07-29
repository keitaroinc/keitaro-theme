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
<?php the_content();?>
</div>
<?php
the_post_thumbnail();
?>
</div>
<?php
get_template_part( SNIPPETS_DIR . '/sidebars/partners' );
?>
<div class="container-fluid pl-0">
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
          <div class='row my-5'>
              <div class='col-md-6 col-12 partners-images-wrapper'>
                  <?php
                  the_post_thumbnail(  array( 'class'  => ' main-partners-image' ) );
                  ?>
                  <div class="custom-partners-image d-flex justify-content-center align-items-center">
                  <?php echo wp_get_attachment_image(get_post_meta(get_the_ID(), 'second_featured_image', true)); ?>
                  </div>
              </div>
              <div class='col-md-6 col-12 partners-text-wrapper'>
                <div class="justify-content-center partners-text">
                <?php
                  the_content();
                ?>
                </div>
            </div>
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
get_sidebar();

get_footer();
