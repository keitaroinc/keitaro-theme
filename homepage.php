<?php
/**
 * Template for homepage
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/*
 * Template Name: Homepage
 */
get_header();

?>

<div class="home-content-wrapper">
  <?php the_content();?>
</div>

<?php
get_footer();
