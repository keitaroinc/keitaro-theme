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

			<?php $site_icon_url = get_site_icon_url( 128 ); ?>
			<?php if ( $site_icon_url ) : ?>
				<div class="text-center">
					<a href="<?php echo esc_url( home_url() ); ?>"><img class="keitaro-symbol" src="<?php echo esc_url( $site_icon_url ); ?>" alt="Keitaro"></a>
				</div>
			<?php endif; ?>
			<div class="row no-gutters justify-content-between">
				<?php get_template_part( SNIPPETS_DIR . '/navigation/footer-menu' ); ?>
				<hr class="d-none d-xs-block d-sm-block">
				<?php get_template_part( SNIPPETS_DIR . '/navigation/social-menu' ); ?>
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
