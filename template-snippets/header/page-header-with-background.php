<?php
/**
 * Temporary snippet for rendering Page headers with a background image
 */

$image_id = get_option( 'keitaro_settings' )['showcases_background_id'];

// phpcs:ignore
echo do_blocks('<!-- wp:cover {"url":"' . wp_get_attachment_url($image_id) . '","id":' . $image_id . ',"dimRatio":70,"focalPoint":{"x":"0.51","y":"0.54"}} -->
<div class="wp-block-cover"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-' . $image_id . '" alt="" src="' . wp_get_attachment_url( $image_id ) . '" style="object-position:51% 54%" data-object-fit="cover" data-object-position="51% 54%"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-align-center has-huge-font-size text-uppercase">' . post_type_archive_title( '', false ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center" style="font-size:24px">' . get_option( 'keitaro_settings' )['showcases_description'] . '</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->'
);
