<?php

/**
 * Widget API: WP_Widget_Text class
 *
 * @package WordPress
 * @subpackage Widgets
 */

/**
 * Core class used to implement a Text widget.
 *
 * @see WP_Widget
 */
class Keitaro_Page_Text extends WP_Widget {

	/**
	 * Sets up a new Text widget instance.
	 */
	public function __construct() {
		parent::__construct(
				'widget_keitaro_page_text', // Base ID
				esc_html__( 'Page Text', 'keitaro' ), // Name
				array(
					'description' => esc_html__( 'Keitaro text widget for pages.', 'keitaro' ),
				) // Args
		);

	}

	/**
	 * Outputs the content for the current Text widget instance.
	 *
	 * @global WP_Post $post
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Text widget instance.
	 */
	public function widget( $args, $instance ) {
		global $post;

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$text  = ! empty( $instance['text'] ) ? $instance['text'] : '';

		if ( isset( $instance['show_on_page'] ) && $instance['show_on_page'] === (string) $post->ID ) :
			echo wp_kses_post( $args['before_widget'] );

			if ( ! empty( $title ) ) {
				echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
			}

			if ( ! empty( $text ) ) {
			?>
			<div class="textwidget"><?php echo wp_kses_post( $text ); ?></div>
			<?php
			}

						echo wp_kses_post( $args['after_widget'] );
		endif;

	}

	/**
	 * Handles updating settings for the current Text widget instance.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['text']         = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
		$instance['show_on_page'] = ( ! empty( $new_instance['show_on_page'] ) ) ? strip_tags( $new_instance['show_on_page'] ) : '';

		return $instance;

	}

	/**
	 * Outputs the Text widget settings form.
	 *
	 * @param array $instance Current settings.
	 * @return void
	 */
	public function form( $instance ) {
		$title        = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$text         = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$show_on_page = ! empty( $instance['show_on_page'] ) ? $instance['show_on_page'] : '';

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Content:' ); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_on_page' ) ); ?>"><?php esc_attr_e( 'Show on page:', 'keitaro' ); ?></label>
			<?php

			$wp_pages = get_posts(
					array(
						'post_type' => 'page',
						'nopaging'  => 1,
						'order'     => 'ASC',
						'orderby'   => 'title',
					)
			);

			if ( $wp_pages ) :

				?>
				<select name="<?php echo esc_attr( $this->get_field_name( 'show_on_page' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'show_on_page' ) ); ?>" class="widefat">
					<option value="0"><?php esc_html_e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $wp_pages as $page ) : ?>
						<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $show_on_page, $page->ID ); ?>>
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

}
