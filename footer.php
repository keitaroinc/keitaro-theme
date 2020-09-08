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
	<div class="container">
		<div class="content main-footer">
			<hr>
			<div class="row no-gutters justify-content-between mt-5">
				<div class="mb-4 social-footer-wrapper">
				<?php get_template_part( SNIPPETS_DIR . '/sidebars/social' ); ?>
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
				<hr class="d-none d-xs-block d-sm-block">
				<div class="footer-list mb-3">
					<h3>- <?php echo wp_get_nav_menu_name('footer-offices') ?> </h3>
				<?php get_template_part( SNIPPETS_DIR . '/navigation/offices-menu' ); ?>
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
