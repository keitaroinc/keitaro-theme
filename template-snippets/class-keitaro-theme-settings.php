<?php
/**
 * Template snippet for custom theme settings
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

/**
 * Theme class used to implement custom theme settings.
 */
class Keitaro_Theme_Settings {

	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'keitaro_settings_page_init' ) );

	}

	/**
	 * Add options page
	 */
	public function add_plugin_page() {
		// Theme settings page will be added under "Settings".
		add_options_page(
			get_bloginfo( 'name' ),
			get_bloginfo( 'name' ),
			'manage_options',
			'keitaro-settings',
			array( $this, 'keitaro_settings_page' )
		);

	}

	/**
	 * Options page callback
	 */
	public function keitaro_settings_page() {

				// Set class property.
		$this->options = get_option( 'keitaro_settings' );

		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Keitaro Settings', 'keitaro' ); ?></h1>
			<form method="post" action="options.php">
				<?php

				// Print out all hidden setting fields.
				settings_fields( 'keitaro_option_group' );
				do_settings_sections( 'keitaro-setting-admin' );
				submit_button();

				?>
			</form>
		</div>
		<?php

	}

	/**
	 * Register and add settings
	 */
	public function keitaro_settings_page_init() {
		register_setting(
			'keitaro_option_group',
			'keitaro_settings',
			array( $this, 'sanitize' )
		);

		add_settings_section(
			'setting_section_id',
			false,
			array( $this, 'section_description' ),
			'keitaro-setting-admin'
		);

		add_settings_field(
			'sales_contact',
			__( 'Sales Contact', 'keitaro' ),
			array( $this, 'sales_contact_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'ga_tracking_id',
			__( 'Google Analytics Tracking ID', 'keitaro' ),
			array( $this, 'google_analytics_tracking_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'gsc_verification_id',
			__( 'Google Search Console ID', 'keitaro' ),
			array( $this, 'google_search_console_verification_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'gst_verification_id',
			__( 'Google Site Tag ID', 'keitaro' ),
			array( $this, 'google_site_tag_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'fb_pixel_id',
			__( 'Facebook Pixel ID', 'keitaro' ),
			array( $this, 'facebook_pixel_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'li_partner_id',
			__( 'LinkedIn Partner ID', 'keitaro' ),
			array( $this, 'li_partner_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'metricool_verification_hash_id',
			__( 'Metricool Hash ID', 'keitaro' ),
			array( $this, 'metricool_verification_hash_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'lead_forensics_id',
			__( 'Lead Forensics ID', 'keitaro' ),
			array( $this, 'lead_forensics_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'lead_feeder_id',
			__( 'Lead Feeder ID', 'keitaro' ),
			array( $this, 'lead_feeder_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'hotjar_id',
			__( 'Hotjar ID', 'keitaro' ),
			array( $this, 'hotjar_id_callback' ),
			'keitaro-setting-admin',
			'setting_section_id'
		);

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input - Contains all settings fields as array keys.
	 */
	public function sanitize( $input ) {

		$new_input = array();

		if ( isset( $input['sales_contact'] ) ) {
			$new_input['sales_contact'] = sanitize_text_field( $input['sales_contact'] );
		}

		if ( isset( $input['ga_tracking_id'] ) ) {
			$new_input['ga_tracking_id'] = sanitize_text_field( $input['ga_tracking_id'] );
		}

		if ( isset( $input['gsc_verification_id'] ) ) {
			$new_input['gsc_verification_id'] = sanitize_text_field( $input['gsc_verification_id'] );
		}

		if ( isset( $input['gst_verification_id'] ) ) {
			$new_input['gst_verification_id'] = sanitize_text_field( $input['gst_verification_id'] );
		}

		if ( isset( $input['fb_pixel_id'] ) ) {
			$new_input['fb_pixel_id'] = sanitize_text_field( $input['fb_pixel_id'] );
		}

		if ( isset( $input['li_partner_id'] ) ) {
			$new_input['li_partner_id'] = sanitize_text_field( $input['li_partner_id'] );
		}

		if ( isset( $input['metricool_verification_hash_id'] ) ) {
			$new_input['metricool_verification_hash_id'] = sanitize_text_field( $input['metricool_verification_hash_id'] );
		}

		if ( isset( $input['lead_forensics_id'] ) ) {
			$new_input['lead_forensics_id'] = sanitize_text_field( $input['lead_forensics_id'] );
		}

		if ( isset( $input['lead_feeder_id'] ) ) {
			$new_input['lead_feeder_id'] = sanitize_text_field( $input['lead_feeder_id'] );
		}

		if ( isset( $input['hotjar_id'] ) ) {
			$new_input['hotjar_id'] = sanitize_text_field( $input['hotjar_id'] );
		}

		return $new_input;

	}

	/**
	 * Print the Section text
	 */
	public function section_description() {
		 printf( '<p>%s</p>', esc_html__( 'A list of customizable theme-specific settings', 'keitaro' ) );

	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function sales_contact_callback() {
		printf(
			'<input type="text" id="sales_contact" name="keitaro_settings[sales_contact]" value="%s" />',
			isset( $this->options['sales_contact'] ) ? esc_attr( $this->options['sales_contact'] ) : ''
		);

	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function google_analytics_tracking_id_callback() {
		printf(
			'<input type="text" id="ga_tracking_id" name="keitaro_settings[ga_tracking_id]" value="%s" />',
			isset( $this->options['ga_tracking_id'] ) ? esc_attr( $this->options['ga_tracking_id'] ) : ''
		);

	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function google_search_console_verification_id_callback() {
		printf(
			'<input type="text" id="gsc_verification_id" name="keitaro_settings[gsc_verification_id]" value="%s" />',
			isset( $this->options['gsc_verification_id'] ) ? esc_attr( $this->options['gsc_verification_id'] ) : ''
		);

	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function google_site_tag_id_callback() {
		printf(
			'<input type="text" id="gst_verification_id" name="keitaro_settings[gst_verification_id]" value="%s" />',
			isset( $this->options['gst_verification_id'] ) ? esc_attr( $this->options['gst_verification_id'] ) : ''
		);

	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function facebook_pixel_id_callback() {
		printf(
			'<input type="text" id="fb_pixel_id" name="keitaro_settings[fb_pixel_id]" value="%s" />',
			isset( $this->options['fb_pixel_id'] ) ? esc_attr( $this->options['fb_pixel_id'] ) : ''
			);
		}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function li_partner_id_callback() {
		printf(
			'<input type="text" id="li_partner_id" name="keitaro_settings[li_partner_id]" value="%s" />',
			isset( $this->options['li_partner_id'] ) ? esc_attr( $this->options['li_partner_id'] ) : ''
			);
		}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function lead_forensics_id_callback() {
		printf(
			'<input type="text" id="lead_forensics_id" name="keitaro_settings[lead_forensics_id]" value="%s" />',
			isset( $this->options['lead_forensics_id'] ) ? esc_attr( $this->options['lead_forensics_id'] ) : ''
			);
		}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function lead_feeder_id_callback() {
		printf(
			'<input type="text" id="lead_feeder_id" name="keitaro_settings[lead_feeder_id]" value="%s" />',
			isset( $this->options['lead_feeder_id'] ) ? esc_attr( $this->options['lead_feeder_id'] ) : ''
			);
		}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function metricool_verification_hash_id_callback() {
		printf(
			'<input type="text" id="metricool_verification_hash_id" name="keitaro_settings[metricool_verification_hash_id]" value="%s" />',
			isset( $this->options['metricool_verification_hash_id'] ) ? esc_attr( $this->options['metricool_verification_hash_id'] ) : ''
		);

	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function hotjar_id_callback() {
		printf(
			'<input type="text" id="hotjar_id" name="keitaro_settings[hotjar_id]" value="%s" />',
			isset( $this->options['hotjar_id'] ) ? esc_attr( $this->options['hotjar_id'] ) : ''
		);

	}

}

if ( is_admin() ) {
	$keitaro_settings = new Keitaro_Theme_Settings();
}
