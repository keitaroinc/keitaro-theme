<?php
/**
 * Template for Keitaro_Button widget
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

class Keitaro_Button extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'widget_keitaro_button', // Base ID
			esc_html__( 'Button', 'keitaro' ), // Name
			array(
				'description' => esc_html__( 'Button item with a selectable link.', 'keitaro' ),
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

		if ( get_queried_object_id() !== (int) $instance['button_link'] ) :

			echo wp_kses_post( $args['before_widget'] );

			echo '<a class="btn btn-outline-secondary" href="' . ( isset( $instance['button_link'] ) ? esc_url( get_permalink( $instance['button_link'] ) ) : '#' ) . '">';
			echo esc_html( get_the_title( $instance['button_link'] ) );
			echo '</a>';

			echo wp_kses_post( $args['after_widget'] );

		endif;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$button_link = ! empty( $instance['button_link'] ) ? $instance['button_link'] : '';

		?>
<p>
	<label for="<?php echo esc_url( $this->get_field_id( 'button_link' ) ); ?>"><?php esc_attr_e( 'Linked page:', 'keitaro' ); ?></label>
	<?php

			$wp_pages = get_posts(
				 array(
					 'post_type' => array( 'post', 'page' ),
					 'nopaging'  => 1,
					 'order'     => 'ASC',
					 'orderby'   => 'title',
				 )
				);

			if ( $wp_pages ) :

		?>
	<select name="<?php echo esc_attr( $this->get_field_name( 'button_link' ) ); ?>"
	 id="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>"
	 class="widefat">
		<option value="0"><?php esc_html_e( '&mdash; Select &mdash;' ); ?>
		</option>
		<?php foreach ( $wp_pages as $page ) : ?>
		<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $button_link, $page->ID ); ?>>
			<?php echo esc_html( $page->post_title ); ?>
		</option>
		<?php endforeach; ?>
	</select>
	<?php

			endif;

			?>
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

		$instance['service_desc'] = ( ! empty( $new_instance['service_desc'] ) ) ? strip_tags( $new_instance['service_desc'] ) : '';
		$instance['button_link']  = ( ! empty( $new_instance['button_link'] ) ) ? strip_tags( $new_instance['button_link'] ) : '';

		return $instance;

	}

}
