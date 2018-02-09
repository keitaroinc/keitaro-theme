<?php
/**
 * Sidebar snippet for keitaro_call_to_action
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_call_to_action';

if ( is_active_sidebar( $sidebar_id ) ) :

	?>

	<div class="call-to-action">
		<ul class="list-inline list-wide">
			<?php

			dynamic_sidebar( $sidebar_id );

			?>
		</ul>
	</div>

	<?php

endif;
