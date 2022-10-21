<?php
/**
 * Template snippet for Google Analytics' tracking code
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$ga_tracking_code = get_option( 'keitaro_settings' )['ga_tracking_id'] ?? false;

if ( $ga_tracking_code ) :

	?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_js( $ga_tracking_code ); ?>"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', '<?php echo esc_js( $ga_tracking_code ); ?>');
	</script>
	<?php

endif;
