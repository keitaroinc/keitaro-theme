<?php
/**
 * Sidebar snippet for keitaro_business
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_business';
if ( is_active_sidebar( $sidebar_id ) ) :
	?>
  
<div class="services-section">
	<h1>Business Development</h1>
	<div class="container px-lg-0 px-5 py-3">
		<div class="row justify-content-center pt-5 mt-5">
			<?php dynamic_sidebar( $sidebar_id ); ?>
		</div>
	</div>
</div>

<?php

endif;
