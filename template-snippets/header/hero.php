<?php
/**
 * Template snippet for .hero
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$hero_class = '';
$header_image = get_header_image();

if ( DEFAULT_HEADER_IMAGE === $header_image ) :
	$header_image_style = 'style="background-image: url(' . esc_attr( $header_image ) . '), url(' . DEFAULT_HEADER_IMAGE_EXTEND . ')"';
else :
	$hero_class = 'hero-non-default';
	$header_image_style = 'style="background-image: url(' . esc_attr( $header_image ) . '); background-size: cover"';
endif;

?>
<div class="hero <?php echo esc_attr( $hero_class ); ?>" <?php echo (esc_url( $header_image ) ? wp_kses( $header_image_style, array( 'style' ) ) : ''); ?>>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-7">
				<?php do_shortcode( '[keitaro-hero-title]' ); ?>
			</div>
		</div>
		<?php get_template_part( SNIPPETS_DIR . '/sidebars/services' ); ?>
	</div>
</div>
