<?php
/**
 * Sidebar snippet for keitaro_product_actions
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_microkubes_actions';

if ( is_active_sidebar( $sidebar_id ) ) :

	?>

	<div class="call-to-action py-5">
		<?php

		dynamic_sidebar( $sidebar_id );

		?>
	</div>

	<?php

endif;
