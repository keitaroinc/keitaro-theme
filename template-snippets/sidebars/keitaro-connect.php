<?php
/**
 * Sidebar snippet for keitaro_connect
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_connect';
if ( is_active_sidebar( $sidebar_id ) ) :
  ?>
  <div class="bg-white my-0">
  <div class="container"><hr class="mt-0"></div>
  <div>
  <div class="d-flex flex-column align-items-center justify-content-center keitaro-connect">
      <?php dynamic_sidebar( $sidebar_id ); ?>
  </div>
<?php

endif;
