<?php
/**
 * Template for products and services pages
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/*
 * Template Name: Products-Services Page
 */
get_header();

?>
<div class="container-fluid services-products-container my-5" >
<?php the_content();?>
</div>
<?php
$title=get_the_title();
if($title=="Microkubes"):
	get_template_part( SNIPPETS_DIR . '/sidebars/product-microkubes-cards' );
	get_template_part( SNIPPETS_DIR . '/sidebars/microkubes-actions' );
endif;
if($title=="Amplus"):
	get_template_part( SNIPPETS_DIR . '/sidebars/product-amplus-cards' );
	get_template_part( SNIPPETS_DIR . '/sidebars/amplus-actions' );
endif;
if (strpos($title, 'Open-source') !== false) {
  get_template_part( SNIPPETS_DIR . '/sidebars/services-open-source-cards' );
  get_template_part( SNIPPETS_DIR . '/sidebars/showcases-open-source' );
  get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );
}
get_footer();
