<?php
/**
 * Sidebar snippet for keitaro_showcases_cloud_services
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_showcases_cloud_services';

if ( is_active_sidebar( $sidebar_id ) ) :

  ?>
<div class="bg-white py-5">
<div class="container">
  <h1 class="custom-block-title" >Showcases</h1>
  <div class="row justify-content-center services-showcases">
	<?php dynamic_sidebar( $sidebar_id ); ?>
  </div>
</div>
</div>
<?php

endif;
