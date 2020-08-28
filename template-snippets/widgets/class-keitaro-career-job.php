<?php

/**
 * Template for Keitaro_Career_Job
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

class Keitaro_Career_Job extends WP_Widget {


	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'widget_keitaro_career_job', // Base ID
			esc_html__( 'Keitaro Career Job', 'keitaro' ), // Name
			array(
				'customize_selective_refresh' => true,
				'description'                 => esc_html__( 'Configurable Job template widget', 'keitaro' ),
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
    $jobclass = str_replace(" ", "-", $instance['title']);
?>
  <div class="row justify-content-center">

      <div class="col-12 p-0 my-2">
        <?php
      // button 
				if ( ! empty( $instance['title'] ) ) {
					?><button value="<?php echo $jobclass  ?>" class="btn btn-primary d-flex justify-content-between job-button" > <?php echo $instance['title']; ?><i class="fa fa-angle-down"></i></button><?php
				}
        ?>
      </div>

      <div class='m-0 p-0 career-content <?php echo $jobclass  ?>' style="display:none;">

        <div class='row'>
          <div class='col-12 px-5 mt-4'>
            <?php if ( ! empty( $instance['description'] ) ) { ?>  
                <?php echo wp_kses_post( apply_filters( 'the_content', $instance['description'] ) ); ?>
            <?php } ?>
          </div>
        </div>
        
        <div class='row'>
        
          <div class='col-md-6'>
          <?php 
          // here
						if ( ! empty( $instance['responsibilities_list'] ) ) :

							$intent_options = explode( "\n", $instance['responsibilities_list'] );

							if ( $intent_options ) : ?>

									<ul class="d-flex flex-column align-items-end dashed-ul">
								    <p>Responsibilities:</p>
										<?php foreach ( $intent_options as $key => $value ) : ?>
											<li value="<?php echo esc_attr( str_replace( ' ', '-', strtolower( $value ) ) ); ?>">
												<?php echo esc_attr( trim( $value ) ); ?></li>
										<?php
										endforeach;
										?>
									</ul>
							<?php

							endif;
            endif;
            // end here
          ?>
          </div>

          <div class="col-md-6">
            <?php 
            // here
              if ( ! empty( $instance['skills_list'] ) ) :

                $intent_options = explode( "\n", $instance['skills_list'] );

                if ( $intent_options ) : ?>

                    <ul class="checked-ul">
                      <p>Skills:</p>
                      <?php foreach ( $intent_options as $key => $value ) : ?>
                        <li value="<?php echo esc_attr( str_replace( ' ', '-', strtolower( $value ) ) ); ?>">
                          <?php echo esc_attr( trim( $value ) ); ?></li>
                      <?php
                      endforeach;
                      ?>
                    </ul>
                <?php

                endif;
              endif;
              // end here
            ?>
          </div> 
        </div>
        <?php $pagelink = get_permalink( get_page_by_title( 'Contact Us' ) );
        ?>

        <div class="row justify-content-end mx-5 my-3"><a href="<?php echo $pagelink  ?>" class="btn btn-primary" >Apply Now</a></div>      
        
        <hr>
      </div>
      
    
  </div>
<?php

}

/**
 * Back-end widget form.
 *
 * @see WP_Widget::form()
 *
 * @param array $instance Previously saved values from database.
 */
public function form( $instance ) {

		$title              = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Job', 'keitaro' ) . ' ' . get_bloginfo( 'name' );
		$description        = ! empty( $instance['description'] ) ? $instance['description'] : __( 'We need bright thinkers like you. Join our team at some of our existing offices or remotely. We offer competitive salary, flexible work hours and much more.', 'keitaro' );
    $responsibilities_list   = ! empty( $instance['responsibilities_list'] ) ? $instance['responsibilities_list'] : __( '', 'keitaro' );
		$skills_list   = ! empty( $instance['skills_list'] ) ? $instance['skills_list'] : __( '', 'keitaro' );
    ?>
    
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'keitaro' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'keitaro' ); ?></label>
		<textarea id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" class="widefat text" style="height: 100px" rows="16" cols="20"><?php echo esc_textarea( $description ); ?></textarea>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'responsibilities_list' ) ); ?>"><?php esc_attr_e( 'Responsibilities list options &mdash; one option per line:', 'keitaro' ); ?></label>
		<textarea id="<?php echo esc_attr( $this->get_field_id( 'responsibilities_list' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'responsibilities_list' ) ); ?>" class="widefat text" style="height: 200px" rows="16" cols="20"><?php echo esc_textarea( $responsibilities_list ); ?></textarea>
  </p>
  <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'skills_list' ) ); ?>"><?php esc_attr_e( 'Skills list options &mdash; one option per line:', 'keitaro' ); ?></label>
		<textarea id="<?php echo esc_attr( $this->get_field_id( 'skills_list' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skills_list' ) ); ?>" class="widefat text" style="height: 200px" rows="16" cols="20"><?php echo esc_textarea( $skills_list ); ?></textarea>
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

		$instance['title']              = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description']        = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
    $instance['responsibilities_list']   = ( ! empty( $new_instance['responsibilities_list'] ) ) ? strip_tags( $new_instance['responsibilities_list'] ) : '';
    $instance['skills_list']   = ( ! empty( $new_instance['skills_list'] ) ) ? strip_tags( $new_instance['skills_list'] ) : '';
		return $instance;
}
}
