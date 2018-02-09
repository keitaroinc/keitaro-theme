<?php
/**
 * Sidebar snippet for keitaro_service_icons
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_service_icons';

if ( is_active_sidebar( $sidebar_id ) ) :

	?>
	<div class="container">
		<ul class="list-service-icons">
			<?php

			dynamic_sidebar( $sidebar_id );

			?>
		</ul>
	</div>
	<?php

endif;
