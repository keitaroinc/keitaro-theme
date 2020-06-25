<?php
/**
 * Template snippet for .hero
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$hero_class   = '';
$header_image = get_header_image();

if ( DEFAULT_HEADER_IMAGE === $header_image ) :
	$header_image_style = 'style="background-image: url(' . esc_attr( $header_image ) . ')"';
else :
	$hero_class         = 'hero-non-default';
	$header_image_style = 'style="background-image: url(' . esc_attr( $header_image ) . '); background-size: cover"';
endif;

?>
<div class="hero <?php echo esc_attr( $hero_class ); ?>" <?php echo ( esc_url( $header_image ) ? wp_kses( $header_image_style, array( 'style' ) ) : '' ); ?>>
	<?php do_shortcode( '[keitaro-hero-title]' ); ?>
</div>

<?php
get_template_part(SNIPPETS_DIR . '/header/slider-partners');
get_template_part( SNIPPETS_DIR . '/sidebars/services' );
