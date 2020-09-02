<?php
/**
 * Sidebar snippet for keitaro_core_team
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_core_team';
if ( is_active_sidebar( $sidebar_id ) ) :
	?>
<div class="core-section text-center">
	<h1 class="mb-0 mt-5">Core Team</h1>
	<div class="container px-lg-0 px-5 ">
		<div class="row justify-content-center pt-5 mt-5">
			<?php dynamic_sidebar( $sidebar_id ); ?>
		</div>
	</div>
</div>


<?php

endif;
