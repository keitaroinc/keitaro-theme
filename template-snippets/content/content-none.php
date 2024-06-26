<?php
/**
 * Template snippet for empty content
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<div class="container">
	<div class="content-area">
		<section class="no-results not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'twentyseventeen' ); ?></h1>
			</header>
			<div class="page-content">
				<?php

				if ( is_home() && current_user_can( 'publish_posts' ) ) :

					?>

					<p>
						<?php

						// translators: Shown when no posts have been published yet and linked to the page for creating a new post.
						echo wp_kses_post( sprintf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'keitaro' ), esc_url( admin_url( 'post-new.php' ) ) ) );

						?>
					</p>

				<?php else : ?>

					<p><?php esc_html_e( "It seems we can't find what you&rsquo;re looking for. Perhaps (re)searching can help.", 'keitaro' ); ?></p>
					<?php

					if ( ! is_search() || ( is_search() && ! have_posts() ) ) :
						get_search_form();
					endif;

				endif;

				?>
			</div><!-- .page-content -->
		</section><!-- .no-results -->
	</div><!-- .content-area -->
</div><!-- .container -->
