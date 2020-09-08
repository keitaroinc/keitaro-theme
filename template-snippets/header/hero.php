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
$header_video = get_header_video_url();
if ( DEFAULT_HEADER_IMAGE === $header_image ) :
$header_image_style = 'style="background-image: url(' . esc_attr( $header_image ) . ')"';
else :
 	$hero_class         = 'hero-non-default';
$header_image_style = 'style="background-image: url(' . esc_attr( $header_image ) . '); background-size: cover"';
 endif;
 if($header_video):
?>

<div class="hero new-hero <?php echo esc_attr( $hero_class ); ?>" <?php echo ( esc_url( $header_image ) ? wp_kses( $header_image_style, array( 'style' ) ) : '' ); ?>>
	<?php do_shortcode( '[keitaro-hero-title]' ); ?>
</div>

<div class="hero-video">
	<div class="hero-video-title d-flex">
		<?php do_shortcode( '[keitaro-hero-title]' ); ?>
	</div>
	<video   autoplay muted loop poster="<?php echo $header_image ?>">
		<source src="<?php echo $header_video ?>"type="video/mp4">		
	</video>
 </div>
<?php
else:
	?>
	<div class="hero <?php echo esc_attr( $hero_class ); ?>" <?php echo ( esc_url( $header_image ) ? wp_kses( $header_image_style, array( 'style' ) ) : '' ); ?>>
	<?php do_shortcode( '[keitaro-hero-title]' ); ?>
</div>
<?php

endif;
get_template_part(SNIPPETS_DIR . '/header/slider-partners');
get_template_part( SNIPPETS_DIR . '/sidebars/services' );

