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

<div class="partners-carousel">
<div class="container" >
	<p >Trusted by</p>
			<div id="carouselExampleControls" class="carousel slide bg-white"  data-ride="carousel">
			<div class="carousel-inner">

				<div class="carousel-item active">
					<div class="row bg-white d-flex flex-wrap align-items-center">
						<div class="col-3 ">
						<img class="d-block img-fluid" src="<?php echo  get_theme_file_uri(); ?>/assets//img//partners-img//parntens-logo-1.png" alt="First slide">
						</div>
						<div class="col-3">
						<img class="d-block  img-fluid" src="<?php echo  get_theme_file_uri(); ?>/assets//img//partners-img//parntens-logo-2.png" alt="Second slide">
						</div>
						<div class="col-3">
						<img class="d-block  img-fluid" src="<?php echo  get_theme_file_uri(); ?>/assets//img//partners-img//parntens-logo-3.png" alt="third slide">
						</div>
						<div class="col-3">
						<img class="d-block  img-fluid" src="<?php echo  get_theme_file_uri(); ?>/assets//img//partners-img//parntens-logo-4.png" alt="forth slide">
						</div>
					</div>
				</div>

				<div class="carousel-item">
				<div class="row bg-white d-flex flex-wrap align-items-center">
						<div class="col-3">
						<img class="d-block img-fluid" src="<?php echo  get_theme_file_uri(); ?>/assets//img//partners-img//parntens-logo-1.png" alt="First slide">
						</div>
						<div class="col-3">
						<img class="d-block img-fluid" src="<?php echo  get_theme_file_uri(); ?>/assets//img//partners-img//parntens-logo-2.png" alt="Second slide">
						</div>
						<div class="col-3">
						<img class="d-block img-fluid" src="<?php echo  get_theme_file_uri(); ?>/assets//img//partners-img//parntens-logo-3.png" alt="third slide">
						</div>
						<div class="col-3">
						<img class="d-block img-fluid" src="<?php echo  get_theme_file_uri(); ?>/assets//img//partners-img//parntens-logo-4.png" alt="forth slide">
						</div>
					</div>
				</div>

			</div>
			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
</div>
</div>

<?php
get_template_part( SNIPPETS_DIR . '/sidebars/services' );
?>