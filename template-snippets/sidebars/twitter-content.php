<?php
/**
 * Sidebar snippet for keitaro_twitter
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

if ( is_home() && $paged < 1 ) : ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<?php dynamic_sidebar( 'keitaro_twitter' ); ?>
			</div>
		</div>
	</div>
	<?php
endif;
