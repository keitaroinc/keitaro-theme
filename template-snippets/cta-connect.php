<?php
// phpcs:ignore
echo do_blocks('<!-- wp:group {"align":"wide"} -->
<div class="wp-block-group">
	<!-- wp:heading {"textAlign":"center","textColor":"black","fontSize":"huge"} -->
	<h2 class="wp-block-heading has-text-align-center has-black-color has-text-color has-huge-font-size">' . $args['title'] . '</h2>
	<!-- /wp:heading -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"}} -->
	<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
		<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="' . get_the_permalink( get_page_by_path( 'contact' ) ) . '">' . $args['button_text'] . '</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->'
);
