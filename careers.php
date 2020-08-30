<?php
/**
 * Template for careers page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/*
 * Template Name: Careers Page
 */
get_header();

?>
<div class="py-5">
  <div class="container-fluid  services-products-container py-5" >
  <?php the_content();?>
  </div>
</div>
<div class='bg-white'>
  <?php
  get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-careers' );
  get_footer();
  ?>
</div>