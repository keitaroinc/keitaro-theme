<?php

class Keitaro_Contact_Form extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'widget_keitaro_contact_form', // Base ID
                esc_html__('Contact Form', 'keitaro'), // Name
                array('description' => esc_html__('Configurable Contact form widget', 'keitaro')) // Args
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

        // Check submitted data and send message
        if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['submit'])) :

            $email_sent = false;
            $autoreply_sent = false;

            $to = 'goce.mitevski@keitaro.com';
            $subject = __('New message from Keitaro.com', 'keitaro');
            $subject_autoreply = __('Thank you for contacting Keitaro Inc.', 'keitaro');
            $company = (isset($_POST['company-name'])) ? trim(esc_html($_POST['company-name'])) : '';
            $company_email = (isset($_POST['business-email'])) ? trim(esc_html($_POST['business-email'])) : '';
            $intent = (isset($_POST['intent'])) ? trim(esc_html($_POST['intent'])) : '';
            $submitted_message = (isset($_POST['message'])) ? str_replace("\r\n", "<br>", trim(esc_html($_POST['message']))) : '';

            $headers = array(
                'Content-Type: text/html; charset=UTF-8',
                'From: Keitaro Inc. <info@keitaro.com>'
            );
            $body = join("<br>", array(
                __('Hello,', 'keitaro') . "<br>",
                sprintf(__('%1$s submitted the following message from %2$s though the contact form on %3$s', 'keitaro'), $company, $company_email, get_permalink()) . "<br>",
                sprintf(__('The intent is: %s', 'keitaro'), str_replace('-', ' ', ucwords($intent))) . "<br>",
                $submitted_message . "<br>",
                __('Regards,', 'keitaro'),
                __('WordPress @ Keitaro Inc.', 'keitaro')
            ));

            $body_autoreply = join("<br>", array(
                __('Hello,', 'keitaro') . "<br>",
                __('Thank you for contacting us at Keitaro Inc. We are just reaching out to confirm that we received your message and will respond as soon as possible.', 'keitaro') . "<br>",
                __('Kind Regards,', 'keitaro'),
                __('Keitaro Inc.', 'keitaro')
            ));

            try {

                // Send mail to Keitaro Inc.
                if (wp_mail($to, $subject, $body, $headers)) :
                    $email_sent = true;
                else:
                    throw new Exception(__("Something's wrong. The email message was not sent to Keitaro Inc.", 'keitaro'));
                endif;

                // Send autoreply to sender
                if (wp_mail($company_email, $subject_autoreply, $body_autoreply, $headers)) :
                    $autoreply_sent = true;
                else:
                    throw new Exception(__("Something's wrong. The auto respond email message was not sent to sender.", 'keitaro'));
                endif;
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
            }

            if ($email_sent && $autoreply_sent):
                echo $args['before_title'] . apply_filters('widget_title￼', __('Message sent', 'keitaro')) . $args['after_title'];

                ?>
                <div class="entry-content">
                    <?php echo (isset($instance['thank_you']) ? apply_filters('the_content', $instance['thank_you']) : ''); ?>
                </div>
                <?php

            endif;

        // Show contact form when nothing has been submitted
        else:

            if (!empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title￼', $instance['title']) . $args['after_title'];
            }

            if (!empty($instance['description'])) {

                ?>
                <div class="entry-content">
                    <?php echo apply_filters('the_content', $instance['description']); ?>
                </div>
                <?php

            }

            ?>
            <form method="POST" class="contact-form" action="<?php esc_url(get_the_permalink()); ?>">

                <?php if (!empty($instance['name_label'])) : ?>            
                    <div class="form-group">
                        <input class="form-control" type="text" name="company-name" id="company-name" required="required" value="<?php echo (isset($_POST['company-name']) ? esc_attr($_POST['company-name']) : '') ?>">
                        <label for="company-name"><?php echo $instance['name_label']; ?></label>
                    </div>
                    <?php

                endif;

                if (!empty($instance['email_label'])) :

                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="business-email" id="business-email" required="required" value="<?php echo (isset($_POST['business-email']) ? esc_attr($_POST['business-email']) : '') ?>">
                        <label for="business-email"><?php echo $instance['email_label']; ?></label>
                    </div>
                    <?php

                endif;

                if (!empty($instance['intent_list'])) :

                    $intent_options = explode("\n", $instance['intent_list']);

                    if ($intent_options):

                        ?>
                        <div class="form-group">

                            <select name="intent" id="intent" class="form-control">
                                <?php foreach ($intent_options as $key => $value): ?>
                                    <option value="<?php echo str_replace(' ', '-', strtolower($value)); ?>"><?php echo trim($value); ?></option>
                                <?php endforeach;

                                ?>
                            </select>
                        </div>
                        <?php

                    endif;
                endif;

                if (!empty($instance['message_label'])) :

                    ?>
                    <div class="form-group">
                        <textarea name="message" id="message" class="form-control" rows="8" required="required"><?php echo (isset($_POST['message']) ? esc_textarea($_POST['message']) : '') ?></textarea>
                        <label for="message"><?php echo $instance['message_label']; ?></label>
                    </div>
                <?php endif;

                ?>
                <input type="hidden" name="submit" id="submit" value="1">
                <?php if (!empty($instance['submit_label'])) : ?>
                    <button type="submit" class="btn btn-primary btn-submit"><?php echo $instance['submit_label']; ?></button>
                <?php endif; ?>
            </form>
        <?php

        endif;

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
        $description = !empty($instance['description']) ? $instance['description'] : '';
        $name_label = !empty($instance['name_label']) ? $instance['name_label'] : __('Company name', 'keitaro');
        $email_label = !empty($instance['email_label']) ? $instance['email_label'] : __('Business email', 'keitaro');
        $intent_list = !empty($instance['intent_list']) ? $instance['intent_list'] : __('Intent...', 'keitaro');
        $message_label = !empty($instance['message_label']) ? $instance['message_label'] : __('How may we help you...', 'keitaro');
        $submit_label = !empty($instance['submit_label']) ? $instance['submit_label'] : __('Contact us', 'keitaro');
        $thank_you = !empty($instance['thank_you']) ? $instance['thank_you'] : __("Thank you for contacting us. You'll hear from us shortly.", 'keitaro');

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php esc_attr_e('Description:', 'keitaro'); ?></label>
            <textarea id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>" class="widefat text" style="height: 100px" rows="16" cols="20"><?php echo esc_textarea($description); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('name_label')); ?>"><?php esc_attr_e('Name field label:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('name_label')); ?>" name="<?php echo esc_attr($this->get_field_name('name_label')); ?>" type="text" value="<?php echo esc_attr($name_label); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email_label')); ?>"><?php esc_attr_e('Email field label:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email_label')); ?>" name="<?php echo esc_attr($this->get_field_name('email_label')); ?>" type="text" value="<?php echo esc_attr($email_label); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('intent_list')); ?>"><?php esc_attr_e('Intent list options &mdash; one option per line:', 'keitaro'); ?></label>
            <textarea id="<?php echo esc_attr($this->get_field_id('intent_list')); ?>" name="<?php echo esc_attr($this->get_field_name('intent_list')); ?>" class="widefat text" style="height: 200px" rows="16" cols="20"><?php echo esc_textarea($intent_list); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('message_label')); ?>"><?php esc_attr_e('Message field label:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('message_label')); ?>" name="<?php echo esc_attr($this->get_field_name('message_label')); ?>" type="text" value="<?php echo esc_attr($message_label); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('submit_label')); ?>"><?php esc_attr_e('Submit button label:', 'keitaro'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('submit_label')); ?>" name="<?php echo esc_attr($this->get_field_name('submit_label')); ?>" type="text" value="<?php echo esc_attr($submit_label); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('thank_you')); ?>"><?php esc_attr_e('Thank you message:', 'keitaro'); ?></label>
            <textarea id="<?php echo esc_attr($this->get_field_id('thank_you')); ?>" name="<?php echo esc_attr($this->get_field_name('thank_you')); ?>" class="widefat text" style="height: 200px" rows="16" cols="20"><?php echo esc_textarea($thank_you); ?></textarea>
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

        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['description'] = (!empty($new_instance['description']) ) ? strip_tags($new_instance['description']) : '';
        $instance['name_label'] = (!empty($new_instance['name_label']) ) ? strip_tags($new_instance['name_label']) : '';
        $instance['email_label'] = (!empty($new_instance['email_label']) ) ? strip_tags($new_instance['email_label']) : '';
        $instance['intent_list'] = (!empty($new_instance['intent_list']) ) ? strip_tags($new_instance['intent_list']) : '';
        $instance['message_label'] = (!empty($new_instance['message_label']) ) ? strip_tags($new_instance['message_label']) : '';
        $instance['submit_label'] = (!empty($new_instance['submit_label']) ) ? strip_tags($new_instance['submit_label']) : '';
        $instance['thank_you'] = (!empty($new_instance['thank_you']) ) ? strip_tags($new_instance['thank_you']) : '';

        return $instance;

    }

}
