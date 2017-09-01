<?php

class Keitaro_Icon_Block extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'widget_keitaro_icon_block', // Base ID
                esc_html__( 'Icon Block', 'keitaro' ), // Name
                array( 'description' => esc_html__( 'Keitaro icon block item for pages.', 'keitaro' ) ) // Args
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
    public function widget($args, $instance) {

        global $post;

        if ( isset( $instance[ 'show_on_page' ] ) && $instance[ 'show_on_page' ] == $post->ID ) :

            echo $args[ 'before_widget' ];

            ?>

            <div class="panel panel-default panel-transparent">
                <div class="panel-heading">
                    <div class="clearfix">
                        <?php if ( isset( $instance[ 'icon' ] ) ) : ?>
                            <img class="panel-title-icon" src="<?php echo keitaro_custom_image_placeholder( $instance[ 'icon' ], false ); ?>" alt="icon">
                        <?php endif ?>
                        <h4 class="panel-title"><?php echo (!empty( $instance[ 'title' ] )) ? apply_filters( 'widget_text', $instance[ 'title' ] ) : ''; ?></h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="panel-value-xs"><?php echo (!empty( $instance[ 'subtitle' ] )) ? apply_filters( 'widget_text', $instance[ 'subtitle' ] ) : ''; ?></span>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="panel-value-xl panel-value-important"><?php echo (!empty( $instance[ 'amount' ] )) ? apply_filters( 'widget_text', $instance[ 'amount' ] ) : ''; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            echo $args[ 'after_widget' ];

        endif;

    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {

        wp_enqueue_script( 'keitaro-custom-image', get_stylesheet_directory_uri() . '/assets/js/custom-image.js' );

        $title = !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $subtitle = !empty( $instance[ 'subtitle' ] ) ? $instance[ 'subtitle' ] : '';
        $amount = !empty( $instance[ 'amount' ] ) ? $instance[ 'amount' ] : '';
        $show_on_page = !empty( $instance[ 'show_on_page' ] ) ? $instance[ 'show_on_page' ] : '';
        $icon = !empty( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : ''

        ?>


        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'keitaro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>"><?php esc_attr_e( 'Subtitle:', 'keitaro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subtitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subtitle' ) ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>"><?php esc_attr_e( 'Amount:', 'keitaro' ); ?></label>
            <input type="number" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'amount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'amount' ) ); ?>" type="text" value="<?php echo esc_attr( $amount ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>"><?php esc_attr_e( 'Icon:', 'keitaro' ); ?></label>
            <input type="number" class="hidden custom-image-value widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>">
        </p>        
        <p>
            <?php keitaro_custom_image_placeholder( $icon ); ?>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'show_on_page' ) ?>"><?php esc_attr_e( 'Show on page:', 'keitaro' ); ?></label>
            <?php

            $wp_pages = get_posts( array(
                'post_type' => 'page',
                'nopaging' => 1,
                'order' => 'ASC',
                'orderby' => 'title',
                    ) );

            if ( $wp_pages ) :

                ?>
                <select name="<?php echo esc_attr( $this->get_field_name( 'show_on_page' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'show_on_page' ) ); ?>" class="widefat">
                    <option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
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
    public function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance[ 'title' ] = (!empty( $new_instance[ 'title' ] ) ) ? strip_tags( $new_instance[ 'title' ] ) : '';
        $instance[ 'subtitle' ] = (!empty( $new_instance[ 'subtitle' ] ) ) ? strip_tags( $new_instance[ 'subtitle' ] ) : '';
        $instance[ 'amount' ] = (!empty( $new_instance[ 'amount' ] ) ) ? strip_tags( $new_instance[ 'amount' ] ) : '';
        $instance[ 'show_on_page' ] = (!empty( $new_instance[ 'show_on_page' ] ) ) ? strip_tags( $new_instance[ 'show_on_page' ] ) : '';
        $instance[ 'icon' ] = (!empty( $new_instance[ 'icon' ] ) ) ? strip_tags( $new_instance[ 'icon' ] ) : '';

        return $instance;

    }

}
