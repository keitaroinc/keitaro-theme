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
<div class="footer-bg">
	<div class="container">
		<div class="content main-footer">
			<hr>
			<div class="row no-gutters justify-content-between mt-5">
			<div class="d-flex flex-column footer-list mb-3">
					<div class="mb-auto">
						<p >Feel free to drop us a note at:</p>
						<h3>hello@keitaro.com</h3>
					</div>
					<div>
						<?php $site_icon_url = get_site_icon_url( 128 ); ?>
						<?php if ( $site_icon_url ) : ?>
								<a href="<?php echo esc_url( home_url() ); ?>"><img class="keitaro-symbol" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Keitaro"></a>
						<?php endif; ?>
						<div>
							<h3><b>Ideas</b> turned into <b>solutions</b></h3>
							<?php get_template_part( SNIPPETS_DIR . '/navigation/social-menu' ); ?>
						</div>
				</div>	
			</div>
			<hr class="d-none d-xs-block d-sm-block">
				<div class="footer-list mb-3">
					<h3>- <?php echo wp_get_nav_menu_name('footer-services') ?> </h3>
				<?php get_template_part( SNIPPETS_DIR . '/navigation/footer-services' ); ?>
				</div>
				<hr class="d-none d-xs-block d-sm-block">
				<div class="footer-list mb-3">
					<h3>- <?php echo wp_get_nav_menu_name('footer') ?> </h3> 
				<?php get_template_part( SNIPPETS_DIR . '/navigation/footer-menu' ); ?>
				</div>
				<hr class="d-none d-xs-block d-sm-block">
				<div class="footer-list mb-3">
					<h3>- <?php echo wp_get_nav_menu_name('footer-products') ?> </h3>
				<?php get_template_part( SNIPPETS_DIR . '/navigation/footer-products' ); ?>
				</div>
			</div>
			<hr>
			<div class="row no-gutters justify-content-between">
				<?php get_template_part( SNIPPETS_DIR . '/navigation/footer-secondary-menu' ); ?>
				<footer class="copyright">
					<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url() ); ?>" class="text-uppercase"><?php bloginfo( 'name' ); ?></a>. <?php esc_html_e( 'Some rights reserved.', 'keitaro' ); ?></p>
				</footer>
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
