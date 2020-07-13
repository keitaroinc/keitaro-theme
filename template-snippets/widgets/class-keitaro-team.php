<?php
/**
 * Template for Keitaro_Team widget
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

class Keitaro_Team extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'widget_keitaro_team', // Base ID
			esc_html__( 'Team', 'keitaro' ), // Name
			array(
				'description' => esc_html__( 'Keitaro team item for landing page section.', 'keitaro' ),
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

		$service_icon = get_the_post_thumbnail( $instance['service_link'] );
		echo wp_kses_post( $args['before_widget'] );

		echo '<div class="service-item team-wrapper d-flex flex-column flex-wrap card-body align-items-center text-center" href="' . ( isset( $instance['service_link'] ) ? esc_url( get_permalink( $instance['service_link'] ) ) : '#' ) . '">';
    echo '<div class="service-header-wrap my-5">';
    if ( isset( $instance['icon'] ) ) : ?>
      <img class="service-icon my-5" src="<?php echo wp_kses_post( keitaro_custom_image_placeholder( $instance['icon'], false ) ); ?>" alt="icon">
      <?php
      endif;
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . wp_kses_post( apply_filters( 'widget_title', $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}
		if ( ! empty( $instance['service_desc'] ) ) {
			printf( '<span class="team-desc">%s</span>', esc_html( apply_filters( 'widget_text', $instance['service_desc'] ) ) );
		}
		echo '</div>';
		echo '<div class="d-flex w-50 row mt-5 justify-content-between" ><a href="#"><i class="fa fa-phone fa-lg"></i></a> <a href="#" ><i class="fa fa-envelope fa-lg"></i>
		</a></div>';
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

		$title        = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$service_desc = ! empty( $instance['service_desc'] ) ? $instance['service_desc'] : '';
		$icon         = ! empty( $instance['icon'] ) ? $instance['icon'] : '';

		?>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Name:', 'keitaro' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
	 name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
	 type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'service_desc' ) ); ?>"><?php esc_attr_e( 'Description:', 'keitaro' ); ?></label>
	<textarea id="<?php echo esc_attr( $this->get_field_id( 'service_desc' ) ); ?>"
	 name="<?php echo esc_attr( $this->get_field_name( 'service_desc' ) ); ?>"
	 class="widefat text" style="height: 200px" rows="16" cols="20"><?php echo esc_textarea( $service_desc ); ?></textarea>
</p>
<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php esc_attr_e( 'Icon:', 'keitaro' ); ?></label>
			<input type="number" class="hidden custom-image-value widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>">
		</p>
    <p>
			<?php keitaro_custom_image_placeholder( $icon ); ?>
		</p>
<p>
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

		$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['service_desc'] = ( ! empty( $new_instance['service_desc'] ) ) ? strip_tags( $new_instance['service_desc'] ) : '';
		$instance['icon']         = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';

		return $instance;

	}

}
