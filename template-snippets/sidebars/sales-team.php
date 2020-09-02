<?php
/**
 * Sidebar snippet for keitaro_sales_team
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_sales_team';
if ( is_active_sidebar( $sidebar_id ) ) :
	?>
<div class="services-section text-center">
	<h1>Sales Team</h1>
	<p>For specific business inquiries, contact someone from the sales team.</p>
	<div class="container px-lg-0 px-5 py-3">
		<div class="row justify-content-center pt-5 mt-5">
			<?php dynamic_sidebar( $sidebar_id ); ?>
		</div>
	</div>
</div>


<?php

endif;
