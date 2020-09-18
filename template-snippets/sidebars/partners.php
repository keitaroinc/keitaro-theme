<?php
/**
 * Sidebar snippet for keitaro_partners
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_partners';

if ( is_active_sidebar( $sidebar_id ) ) :

  ?>
<div class="container">
  <div class="row justify-content-center">
	<?php dynamic_sidebar( $sidebar_id ); ?>
  </div>
</div>
<?php

endif;
