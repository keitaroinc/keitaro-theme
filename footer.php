<?php
/**
 * Template for displaying the footer
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<div class="footer-bg bg-white">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<hr>
				<div class="content main-footer">
					<div class="d-flex flex-wrap px-3">
						<?php get_template_part( SNIPPETS_DIR . '/sidebars/footer-widgets' ); ?>
					</div>
					<?php $site_icon_url = get_site_icon_url( 128 ); ?>
					<?php if ( $site_icon_url ) : ?>
						<a href="<?php echo esc_url( home_url() ); ?>"><img class="keitaro-symbol" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Keitaro"></a>
					<?php endif; ?>
					<div class="d-flex flex-wrap px-3">
						<?php get_template_part( SNIPPETS_DIR . '/sidebars/social-media-widgets' ); ?>
					</div>
					<hr>
					<div class="d-flex flex-wrap justify-content-between">
						<?php get_template_part( SNIPPETS_DIR . '/navigation/footer-secondary-menu' ); ?>
						<footer class="copyright">
							<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>. <?php esc_html_e( 'Some rights reserved.', 'keitaro' ); ?></p>
						</footer>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</div>
<?php

keitaro_go_to_top_link( __( 'Go to Top', 'keitaro' ) );

get_template_part( SNIPPETS_DIR . '/google-analytics' );

?>
</body>
</html>
