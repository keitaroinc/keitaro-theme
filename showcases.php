<?php
/**
 * Template for showcases page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/*
 * Template Name: Showcases Page
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
get_template_part( SNIPPETS_DIR . '/sidebars/showcases' );
get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );
get_sidebar();

get_footer();
