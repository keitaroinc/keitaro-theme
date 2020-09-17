<?php
/**
 * Sidebar snippet for keitaro_careers
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_careers';

if ( is_active_sidebar( $sidebar_id ) ) :
?>
<div class="container">
  <div class="row justify-content-center keitaro-careers-wrapper">
	<?php
	  dynamic_sidebar( $sidebar_id );
	?>
  </div>
</div>

<?php
endif;
