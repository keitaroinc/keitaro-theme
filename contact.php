<?php
/**
 * Template Name: Contact Page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

get_header();

?>
			<?php
			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					?>
						<div class="showcases-header d-flex flex-column">
							<div class="showcases-content">
							<?php the_content();?>
							</div>
							<?php the_post_thumbnail();?>
						</div>
					<?php
				endwhile;
			else :
				get_template_part( SNIPPETS_DIR . '/content/content-none' );
			endif;			
		?>

<div class="container contact-container my-5 pt-5 pb-1">
  <div class="row checkboxes-row" id="checkboxes">
	<?php get_template_part(SNIPPETS_DIR . '/radio-box');?>
  <div class="row px-5 d-flex my-5 py-5 flex-column">
		<div class="1 radio-show-content" class="" style="display:none;"><?php get_template_part( SNIPPETS_DIR . '/sidebars/get-quote' ); ?></div>
    <div class="2 radio-show-content"style="display:none" ><?php get_template_part( SNIPPETS_DIR . '/content/content-contact-page' ); ?></div>
    <div class="3 radio-show-content" style="display:none"><?php get_template_part( SNIPPETS_DIR . '/sidebars/information-about-products' ); ?></div>
    <div class="4 radio-show-content" style="display:none" ><?php get_template_part( SNIPPETS_DIR . '/sidebars/partner-with-keitaro' ); ?></div>
    <div class="5 radio-show-content"  style="display:block"><?php get_template_part( SNIPPETS_DIR . '/content/content-job-application-page' ); ?></div>
    <div class="6 radio-show-content" style="display:none" ><?php get_template_part( SNIPPETS_DIR . '/sidebars/information-other' ); ?></div>
	</div>
</div>
<div class="my-5 py-5">
	<?php get_template_part( SNIPPETS_DIR . '/sidebars/sales-team' );?>
</div>
<?php
get_sidebar();

get_footer();
