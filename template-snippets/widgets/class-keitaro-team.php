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

		echo wp_kses_post( $args['before_widget'] );
   
		echo '<div class="team-card p-4 d-flex flex-column" >';if ( isset( $instance['icon'] ) ) : ?>
			<div class='d-flex justify-content-center'>
      	<img class="" style="width:130px;border-radius:50%;" src="<?php echo wp_kses_post( keitaro_custom_image_placeholder( $instance['icon'], false ) ); ?>" alt="icon">
			</div>
			<?php
      endif;
    echo '<div class=" py-4">';
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . wp_kses_post( apply_filters( 'widget_title', $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}
		if ( ! empty( $instance['member_desc'] ) ) {
			printf( '<span class="team-desc">%s</span>', esc_html( apply_filters( 'widget_text', $instance['member_desc'] ) ) );
		}
		echo '</div>';
		if ( isset( $instance['phone_number'] ) || isset($instance['mail_to'])) :
		?>
		<div class="d-flex w-100 mt-auto pt-4 pb-2 justify-content-lg-between justify-content-center" ><p><a href="tel:<?php echo $instance['phone_number'] ?>" title="Call us"><i class="fa fa-phone fa-lg"></i></a></p> <p><a href="mailto:<?php 
		echo $instance['mail_to']; ?>" title="Mail us"><i class="fa fa-envelope fa-lg"></i>
		</a></p></div>
		<?php
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
		$member_desc = ! empty( $instance['member_desc'] ) ? $instance['member_desc'] : '';
		$phone_number	= ! empty( $instance['phone_number'] ) ? $instance['phone_number'] : '';
		$mail_to	= ! empty( $instance['mail_to'] ) ? $instance['mail_to'] : '';
		$icon         = ! empty( $instance['icon'] ) ? $instance['icon'] : '';

		?>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Name:', 'keitaro' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
	 name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
	 type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'member_desc' ) ); ?>"><?php esc_attr_e( 'Description:', 'keitaro' ); ?></label>
	<textarea id="<?php echo esc_attr( $this->get_field_id( 'member_desc' ) ); ?>"
	 name="<?php echo esc_attr( $this->get_field_name( 'member_desc' ) ); ?>"
	 class="widefat text" style="height: 200px" rows="16" cols="20"><?php echo esc_textarea( $member_desc ); ?></textarea>
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'phone_number' ) ); ?>"><?php esc_attr_e( 'Phone Number:', 'keitaro' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_number' ) ); ?>"
	 name="<?php echo esc_attr( $this->get_field_name( 'phone_number' ) ); ?>"
	 type="text" value="<?php echo esc_attr( $phone_number ); ?>">
</p>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'mail_to' ) ); ?>"><?php esc_attr_e( 'Mail to :', 'keitaro' ); ?></label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'mail_to' ) ); ?>"
	 name="<?php echo esc_attr( $this->get_field_name( 'mail_to' ) ); ?>"
	 type="text" value="<?php echo esc_attr( $mail_to ); ?>">
</p>
<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php esc_attr_e( 'Icon:', 'keitaro' ); ?></label>
		<input type="number" class="hidden custom-image-value widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>">
</p>
<p>
			<?php keitaro_custom_image_placeholder( $icon ); ?>
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
		$instance['member_desc'] = ( ! empty( $new_instance['member_desc'] ) ) ? strip_tags( $new_instance['member_desc'] ) : '';
		$instance['phone_number'] = ( ! empty( $new_instance['phone_number'] ) ) ? strip_tags( $new_instance['phone_number'] ) : '';
		$instance['mail_to'] = ( ! empty( $new_instance['mail_to'] ) ) ? strip_tags( $new_instance['mail_to'] ) : '';
		$instance['icon']         = ( ! empty( $new_instance['icon'] ) ) ? strip_tags( $new_instance['icon'] ) : '';

		return $instance;

	}

}
