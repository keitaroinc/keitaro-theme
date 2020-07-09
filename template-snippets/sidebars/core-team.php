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
  
<div class="container-fluid core-section">
	<div class="row no-gutters">
		<div class='my-5 col-12 text-center'>
			<h1 class="mt-5">Core Team</h1>
			</div>
		<div class="col-lg-10 offset-lg-1">
			<div class="services card-deck">
				<?php dynamic_sidebar( $sidebar_id ); ?>
			</div>
		</div>
	</div>
</div>
<?php

endif;
