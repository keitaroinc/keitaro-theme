<?php
/**
 * Sidebar snippet for keitaro_locations
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_locations';

if ( is_active_sidebar( $sidebar_id ) ) :

	?>
	<div class="locations">
		<?php dynamic_sidebar( $sidebar_id ); ?>
	</div>
	<?php

endif;
