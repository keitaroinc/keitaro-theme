<?php
/**
 * Template for Keitaro_Showcase widget
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

class Keitaro_Showcase extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'widget_keitaro_showcase', // Base ID
			esc_html__( 'Showcase', 'keitaro' ), // Name
			array(
				'description' => esc_html__( 'Keitaro showcase item for the sidebar on showcases page.', 'keitaro' ),
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
	if ( empty( $instance['color'] ) ) :
			  $color = '#1e9843';
	else :
	  $color = $instance['color'];
	endif;
		$service_icon = get_the_post_thumbnail( $instance['service_link'] );
		echo wp_kses_post( $args['before_widget'] );
		echo '<div class="showcase-inner text-center p-3 mx-3" style="height:100%;background: linear-gradient(to bottom, ',$color,' 80%, #f2f2f2 20%)!important;">';
		echo '<div class="my-5">';

		if ( ! empty( $instance['title'] ) ) {
		echo wp_kses_post( $args['before_title'] ) . wp_kses_post( apply_filters( 'widget_title', $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
	}
		echo '</div>';
		echo '<a class="btn btn-outline-light p-3 mb-5" href="' . ( isset( $instance['service_link'] ) ? esc_url( get_permalink( $instance['service_link'] ) ) : '#' ) . '">View Showcase</a>';
		if ( $service_icon ) :
		echo '<div class="showcase-icon">';
		echo get_the_post_thumbnail( $instance['service_link'] );
		echo '</div>';
	endif;
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
	$service_link = ! empty( $instance['service_link'] ) ? $instance['service_link'] : '';
	$color = ! empty( $instance['color'] ) ? $instance['color'] : '';

		?>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Name:', 'keitaro' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
	 name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
	 type="text" value="<?php echo esc_attr( $title ); ?>">
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>"><?php esc_attr_e( 'Color:', 'keitaro' ); ?></label>
	<input  id="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>"
   name="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>"
   type="color" value="<?php echo esc_attr( $color ); ?>"
	 >
</p>
<!-- <input type="color" id="favcolor" name="favcolor" value="#ff0000"> -->

<p>
	<label for="<?php echo esc_url( $this->get_field_id( 'service_link' ) ); ?>"><?php esc_attr_e( 'Linked page:', 'keitaro' ); ?></label>
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
	<select name="<?php echo esc_attr( $this->get_field_name( 'service_link' ) ); ?>"
	 id="<?php echo esc_attr( $this->get_field_id( 'service_link' ) ); ?>"
	 class="widefat">
		<option value="0"><?php esc_html_e( '&mdash; Select &mdash;' ); ?>
		</option>
		<?php foreach ( $wp_pages as $page ) : ?>
		<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $service_link, $page->ID ); ?>>
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

		$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['service_link'] = ( ! empty( $new_instance['service_link'] ) ) ? strip_tags( $new_instance['service_link'] ) : '';
		$instance['color'] = ( ! empty( $new_instance['color'] ) ) ? strip_tags( $new_instance['color'] ) : '';

		return $instance;

	}
}
