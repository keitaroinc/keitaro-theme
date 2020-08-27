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
$parent =$post->post_parent;
$title=get_the_title();

// services

if (get_the_title($parent)=="Services"):
  if (strpos($title, 'Open-source') !== false) {
    get_template_part( SNIPPETS_DIR . '/sidebars/services-open-source-cards' );
    get_template_part( SNIPPETS_DIR . '/sidebars/showcases-open-source' );
    get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );
  }
  if (strpos($title, 'Cloud Services') !== false) {
    get_template_part( SNIPPETS_DIR . '/sidebars/cloud-services-cards' );
    get_template_part( SNIPPETS_DIR . '/sidebars/showcases-cloud-services' );
    get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );
  }
  if (strpos($title, 'CKAN') !== false) {
    get_template_part( SNIPPETS_DIR . '/sidebars/ckan-services-cards' );
    get_template_part( SNIPPETS_DIR . '/sidebars/showcases-ckan-services' );
    get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );
  }
  if (strpos($title, 'Security') !== false) {
    get_template_part( SNIPPETS_DIR . '/sidebars/security-licensing-services-cards' );
    get_template_part( SNIPPETS_DIR . '/sidebars/showcases-security-licensing-services' );
    get_template_part( SNIPPETS_DIR . '/sidebars/keitaro-connect' );
  }
endif;

// products

if($title=="Microkubes"):
	get_template_part( SNIPPETS_DIR . '/sidebars/product-microkubes-cards' );
	get_template_part( SNIPPETS_DIR . '/sidebars/microkubes-actions' );
endif;
if($title=="Amplus"):
	get_template_part( SNIPPETS_DIR . '/sidebars/product-amplus-cards' );
	get_template_part( SNIPPETS_DIR . '/sidebars/amplus-actions' );
endif;


get_footer();
