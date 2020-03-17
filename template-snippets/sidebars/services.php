<?php
/**
 * Sidebar snippet for keitaro_services
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_services';

if ( is_active_sidebar( $sidebar_id ) ) :

	?>
<div class="container-fluid">
	<div class="row no-gutters">
		<div class="col-lg-10 offset-lg-1">
			<div class="services card-deck">
				<?php dynamic_sidebar( $sidebar_id ); ?>
			</div>
		</div>
	</div>
</div>
<?php

endif;
