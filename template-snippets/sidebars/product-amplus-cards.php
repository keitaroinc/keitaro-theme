<?php
/**
 * Sidebar snippet for keitaro_cards
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_amplus_cards';

if ( is_active_sidebar( $sidebar_id ) ) :

  ?>
<div class="bg-white">
<div class="container py-5">
  <div class="row justify-content-center pt-5 mt-5">
    <?php dynamic_sidebar( $sidebar_id ); ?>
  </div>
</div>
</div>
<?php

endif;
