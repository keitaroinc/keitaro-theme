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
<div class="bg-white">
  <?php get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-careers' );?>
</div>
<?php
get_footer();
