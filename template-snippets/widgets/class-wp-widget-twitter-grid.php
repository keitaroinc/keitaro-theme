<?php

class Keitaro_Twitter_Grid extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'widget_keitaro_twitter_grid', // Base ID
                esc_html__('Twitter Grid', 'keitaro'), // Name
                array('description' => esc_html__('Twitter timeline grid widget', 'keitaro')) // Args
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

        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        if (!empty($instance['timeline_url'])) {

            ?>
            <a class="twitter-<?php echo (!empty($instance['timeline_type']) ? esc_attr($instance['timeline_type']) : ''); ?>" data-lang="en" data-dnt="true" href="<?php echo esc_url($instance['timeline_url']); ?>"><?php echo apply_filters('widget_title', $instance['title']); ?></a>
            <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            <?php

        }

        echo $args['after_widget'];

    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {

        $title = !empty($instance['title']) ? $instance['title'] : '';
        $timeline_url = !empty($instance['timeline_url']) ? $instance['timeline_url'] : '';
        $timeline_type = !empty($instance['timeline_type']) ? $instance['timeline_type'] : '';

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Name:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('timeline_url')); ?>"><?php esc_attr_e('Timeline URL:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('timeline_url')); ?>" name="<?php echo esc_attr($this->get_field_name('timeline_url')); ?>" type="text" value="<?php echo esc_attr($timeline_url); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('timeline_type') ?>"><?php esc_attr_e('Timeline Type:', 'keitaro'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('timeline_type')); ?>" id="<?php echo esc_attr($this->get_field_id('timeline_type')); ?>" class="widefat">
                <option value="0"><?php _e('&mdash; Select &mdash;'); ?></option>
                <option <?php selected($timeline_type, 'grid'); ?> value="grid"><?php _e('Grid', 'keitaro'); ?></option>
                <option <?php selected($timeline_type, 'timeline'); ?> value="timeline"><?php _e('Timeline', 'keitaro'); ?></option>
            </select>
        <p>
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

            $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['timeline_url'] = (!empty($new_instance['timeline_url']) ) ? strip_tags($new_instance['timeline_url']) : '';
            $instance['timeline_type'] = (!empty($new_instance['timeline_type']) ) ? strip_tags($new_instance['timeline_type']) : '';

            return $instance;

        }

    }
    