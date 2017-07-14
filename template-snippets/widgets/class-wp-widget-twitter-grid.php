<?php

class Keitaro_Tweets extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'widget_keitaro_twitter_grid', // Base ID
                esc_html__('Tweets', 'keitaro'), // Name
                array('description' => esc_html__('Timeline or grid content from Twitter.', 'keitaro')) // Args
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

        if (!empty($instance['tweets_url'])) {

            ?>
            <a class="twitter-<?php echo (!empty($instance['tweets_type']) ? esc_attr($instance['tweets_type']) : ''); ?>" data-lang="en" data-dnt="true" href="<?php echo esc_url($instance['tweets_url']); ?>"><?php echo apply_filters('widget_title', $instance['title']); ?></a>
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
        $tweets_url = !empty($instance['tweets_url']) ? $instance['tweets_url'] : '';
        $tweets_type = !empty($instance['tweets_type']) ? $instance['tweets_type'] : '';
        $visualization_type = array(
            'grid' => __('Used with timeline URLs', 'keitaro'),
            'timeline' => __('Used with profile URLs', 'keitaro')
        );

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('tweets_url')); ?>"><?php esc_attr_e('Twitter URL:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tweets_url')); ?>" name="<?php echo esc_attr($this->get_field_name('tweets_url')); ?>" type="text" value="<?php echo esc_attr($tweets_url); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tweets_type') ?>"><?php esc_attr_e('Show as:', 'keitaro'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('tweets_type')); ?>" id="<?php echo esc_attr($this->get_field_id('tweets_type')); ?>" class="widefat">
                <option value="0"><?php _e('&mdash; Select &mdash;'); ?></option>
                <?php foreach ($visualization_type as $key => $value) : ?>
                    <option <?php selected($tweets_type, $key); ?> value="<?php echo $key; ?>"><?php echo ucfirst($key) . ' &ndash; ' . $value; ?></option>
                <?php endforeach; ?>
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
            $instance['tweets_url'] = (!empty($new_instance['tweets_url']) ) ? strip_tags($new_instance['tweets_url']) : '';
            $instance['tweets_type'] = (!empty($new_instance['tweets_type']) ) ? strip_tags($new_instance['tweets_type']) : '';

            return $instance;

        }

    }
    