<?php
/**
 * Sidebar snippet for keitaro_cards
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_cards';

if ( is_active_sidebar( $sidebar_id ) ) :

  ?>
<div class="bg-white">
<div class="container">
  <div class="row justify-content-center">
    <?php dynamic_sidebar( $sidebar_id ); ?>
  </div>
</div>
</div>
<?php

endif;
