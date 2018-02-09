<?php
/**
 * Template snippet for empty content of each child page
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'No child pages assigned', 'keitaro' ); ?></h1>
	</header>
	<div class="page-content">
		<p>
			<?php

			// translators: Displayed when no child pages have been assigned and linked to the Edit page of the current page
			printf( wp_kses_post( __( 'This does not currently have any child pages assigned to it. <a href="%1$s">Please assign some</a>, to automatically load their content here. The child pages can also have child pages and can be ordered through their Order value.', 'keitaro' ), add_query_arg( 'post_type', 'page', esc_url( admin_url( 'edit.php' ) ) ) ) );

			?>
		</p>
	</div>
</section>
