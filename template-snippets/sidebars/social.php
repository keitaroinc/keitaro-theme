<?php
/**
 * Sidebar snippet for social footer
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$sidebar_id = 'keitaro_social';

if ( is_active_sidebar( $sidebar_id ) ) :

	?>

	<div class="social-footer">
		<?php

		dynamic_sidebar( $sidebar_id );

		?>
	</div>

	<?php

endif;
