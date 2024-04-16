<?php
/**
 * Template snippet for Lead Forensics
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

$lead_forensics_id = get_option( 'keitaro_settings' )['lead_forensics_id'] ?? false;

if ( $lead_forensics_id ) :

	?>
	<?php // phpcs:ignore ?>
	<script type="text/javascript" src="https://secure.intelligent-data-247.com/js/<?php echo esc_js( $lead_forensics_id ); ?>.js"></script>
	<noscript><img alt="" src="https://secure.intelligent-data-247.com/<?php echo esc_js( $lead_forensics_id ); ?>.png" style="display:none;" /></noscript>
	<?php

endif;
