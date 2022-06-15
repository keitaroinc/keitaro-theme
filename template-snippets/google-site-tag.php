<?php

/**
 * Template snippet for Google Site Tag ID
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$gst_id = get_option('keitaro_settings')['gst_verification_id'] ?? false;

if ($gst_id) :

?>
	<!-- Global site tag (gtag.js) - Google Ads: 411451537 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_js( $gst_id ); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', '<?php echo esc_js( $gst_id ); ?>');
	</script>
<?php

endif;
