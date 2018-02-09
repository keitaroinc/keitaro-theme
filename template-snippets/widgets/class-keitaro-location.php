<?php

class Keitaro_Location extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'widget_keitaro_location', // Base ID
			esc_html__( 'Location', 'keitaro' ), // Name
			array(
				'description' => esc_html__( 'Keitaro location widget with interactive map and address. The map is rendered automatically from the location address.', 'keitaro' ),
			) // Args
		);

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo wp_kses_post( $args['before_widget'] );

		if ( ! empty( $instance['location'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . wp_kses_post( sprintf( '<span class="location-title-prefix">%s</span>: ', get_bloginfo( 'name' ) ) . apply_filters( 'widget_title', $instance['location'] ) ) . wp_kses_post( $args['after_title'] );
		}

		if ( ! empty( $instance['location_address'] ) ) {

			?>
			<div class="location-map-container">
									<iframe class="location-map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo rawurlencode( $instance['location_address'] ); ?>&amp;output=embed"></iframe>
			</div>
			<?php

			printf( '<address class="location-address">%s</address>', esc_html( apply_filters( 'widget_text', $instance['location_address'] ) ) );
		}

		echo '<div class="location-details">';
		if ( ! empty( $instance['location_phone'] ) ) {
						// translators: %1$s stands for the location phone number set in the widget
			printf( '<a href="tel:%1$s" title="%2$s">%1$s</a>, ', esc_html( $instance['location_phone'] ), esc_attr__( 'Call %1$s now', 'keitaro' ) );
		}

		if ( ! empty( $instance['location_email'] ) ) {
						// translators: %1$s stands for the location email address set in the widget
			printf( '<a href="mailto:%1$s" title="%2$s">%1$s</a>', esc_html( antispambot( $instance['location_email'] ) ), esc_attr__( 'Email %1$s now', 'keitaro' ) );
		}
		echo '</div>';

		echo wp_kses_post( $args['after_widget'] );

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$location = ! empty( $instance['location'] ) ? $instance['location'] : '';
		$location_address = ! empty( $instance['location_address'] ) ? $instance['location_address'] : '';
		$location_phone = ! empty( $instance['location_phone'] ) ? $instance['location_phone'] : '';
		$location_email = ! empty( $instance['location_email'] ) ? $instance['location_email'] : '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>"><?php esc_attr_e( 'Name:', 'keitaro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'location' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'location' ) ); ?>" type="text" value="<?php echo esc_attr( $location ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'location_address' ) ); ?>"><?php esc_attr_e( 'Address:', 'keitaro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'location_address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'location_address' ) ); ?>" type="text" value="<?php echo esc_attr( $location_address ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'location_phone' ) ); ?>"><?php esc_attr_e( 'Phone Number:', 'keitaro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'location_phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'location_phone' ) ); ?>" type="tel" value="<?php echo esc_attr( $location_phone ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'location_email' ) ); ?>"><?php esc_attr_e( 'Email:', 'keitaro' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'location_email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'location_email' ) ); ?>" type="email" value="<?php echo esc_attr( $location_email ); ?>">
		</p>
		<?php

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['location'] = ( ! empty( $new_instance['location'] ) ) ? strip_tags( $new_instance['location'] ) : '';
		$instance['location_address'] = ( ! empty( $new_instance['location_address'] ) ) ? strip_tags( $new_instance['location_address'] ) : '';
		$instance['location_phone'] = ( ! empty( $new_instance['location_phone'] ) ) ? strip_tags( $new_instance['location_phone'] ) : '';
		$instance['location_email'] = ( ! empty( $new_instance['location_email'] ) ) ? strip_tags( $new_instance['location_email'] ) : '';

		return $instance;

	}

}
