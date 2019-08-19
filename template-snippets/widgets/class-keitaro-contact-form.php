<?php

/**
 * Template for Keitaro_Contact_Form widget
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */

class Keitaro_Contact_Form extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */
	public function __construct()
	{
		parent::__construct(
			'widget_keitaro_contact_form', // Base ID
			esc_html__('Contact Form', 'keitaro'), // Name
			array(
				'description' => esc_html__('Configurable Contact form widget', 'keitaro'),
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
	public function widget($args, $instance)
	{

		echo wp_kses_post($args['before_widget']);

		?>

	<div class="row">
		<div class="col-md-12 col-lg-offset-1 col-lg-2">
			<?php

			if ('' !== get_the_post_thumbnail() && !is_single()) :
				get_template_part(SNIPPETS_DIR . '/post-thumbnail');
			endif;

			keitaro_child_pages_list(get_the_ID());

			?>
		</div>
		<div class="col-md-12 col-lg-4">
			<?php

			if (get_the_content()) :
				get_template_part(SNIPPETS_DIR . '/header/entry-header');
				get_template_part(SNIPPETS_DIR . '/entry-content');
			endif;

			if (('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['submit'])) && wp_verify_nonce($_REQUEST['_wpnonce'], 'contact-form-widget')) :

				$email_sent     = false;
				$autoreply_sent = false;

				$send_to           = !empty($instance['sent_to']) ? $instance['sent_to'] : get_option('admin_email');
				$subject           = __('New message from Keitaro.com', 'keitaro');
				$subject_autoreply = __('Thank you for contacting Keitaro Inc.', 'keitaro');
				$sender            = (isset($_POST['sender-name'])) ? trim(esc_html($_POST['sender-name'])) : '';
				$sender_email      = (isset($_POST['sender-email'])) ? trim(esc_html($_POST['sender-email'])) : '';
				$intent            = (isset($_POST['intent'])) ? trim(esc_html($_POST['intent'])) : '';
				$submitted_message = (isset($_POST['message'])) ? str_replace("\r\n", '<br>', trim(esc_html($_POST['message']))) : '';

				$headers = array(
					'Content-Type: text/html; charset=UTF-8',
					'From: ' . get_bloginfo('name') . ' <' . $send_to . '>',
				);
				$body    = join(
					'<br>',
					array(
						__('Hello,', 'keitaro') . '<br>',
						// translators: Who submitted a message from where, in the auto send admin email
						sprintf(__('%1$s submitted the following message from %2$s though the contact form on %3$s.', 'keitaro'), $sender, $sender_email, get_permalink()) . '<br>',
						$submitted_message . '<br>',
						// translators: What was the intent for sending an email
						sprintf(__('The intent is: %s', 'keitaro'), str_replace('-', ' ', ucwords($intent))) . '<br>',
						__('Regards,', 'keitaro'),
						// translators: %s stands for get_bloginfo('name')
						sprintf(__('WordPress @ %s', 'keitaro'), get_bloginfo('name')),
					)
				);

				$body_autoreply = join(
					'<br>',
					array(
						__('Hello,', 'keitaro') . '<br>',
						// translators: %s stands for get_bloginfo('name')
						sprintf(__('Thank you for contacting us at %s. We are just reaching out to confirm that we received your message and will respond as soon as possible.', 'keitaro'), get_bloginfo('name')) . '<br>',
						__('Kind Regards,', 'keitaro'),
						get_bloginfo('name') . '<br>',
						esc_url(get_home_url()),
						$send_to,
					)
				);

				try {

					if (true === keitaro_akismet_check_spam($submitted_message)) :
						throw new Exception(__("Seems like you are trying to submit spam. Sorry, that's not allowed.", 'keitaro'));
					endif;

					// Send mail to Keitaro Inc.
					if (wp_mail($send_to, $subject, $body, $headers)) :
						$email_sent = true;
					else :
						throw new Exception(__("Something's wrong. The email message was not delivered to sender.", 'keitaro'));
					endif;

					// Send autoreply to sender
					if (wp_mail($sender_email, $subject_autoreply, $body_autoreply, $headers)) :
						$autoreply_sent = true;
					else :
						throw new Exception(__("Something's wrong. The auto respond email message was not delivered to sender.", 'keitaro'));
					endif;

				} catch (Exception $e) {

					echo 'Caught exception: ', wp_kses_post($e->getMessage()), "\n";
				}

				if ($email_sent && $autoreply_sent) :
					echo wp_kses_post($args['before_title']) . wp_kses_post(apply_filters('widget_title', __('Message sent', 'keitaro'))) . wp_kses_post($args['after_title']);

					?>
					<div class="entry-content">
						<?php echo wp_kses_post(isset($instance['thank_you']) ? apply_filters('the_content', $instance['thank_you']) : ''); ?>
					</div>
				<?php

				endif;
			else :
				if (!empty($instance['title'])) {
					echo wp_kses_post($args['before_title']) . wp_kses_post(apply_filters('widget_title', $instance['title'])) . wp_kses_post($args['after_title']);
				}

				if (!empty($instance['description'])) {

					?>
					<div class="entry-content">
						<?php echo wp_kses_post(apply_filters('the_content', $instance['description'])); ?>
					</div>
				<?php

				}
			endif;

			?>
			<?php

			// Check submitted data and send message
			if (false === isset($_POST['submit'])) :

				// Show contact form when nothing has been submitted
				?>
				<form method="POST" class="contact-form" action="<?php echo esc_url(wp_nonce_url(add_query_arg('send-mail', true, get_the_permalink()))); ?>">

					<?php if (!empty($instance['name_label'])) : ?>
						<div class="form-group">
							<input class="form-control" type="text" name="sender-name" id="sender-name" required="required" value="<?php echo (isset($_POST['sender-name']) ? esc_attr($_POST['sender-name']) : ''); ?>">
							<label for="sender-name"><?php echo esc_html($instance['name_label']); ?></label>
						</div>
					<?php

					endif;

					if (!empty(esc_html($instance['email_label']))) :

						?>
						<div class="form-group">
							<input class="form-control" type="email" name="sender-email" id="sender-email" required="required" value="<?php echo (isset($_POST['sender-email']) ? esc_attr($_POST['sender-email']) : ''); ?>">
							<label for="sender-email"><?php echo esc_html($instance['email_label']); ?></label>
						</div>
					<?php

					endif;

					if (!empty($instance['intent_list'])) :

						$intent_options = explode("\n", $instance['intent_list']);

						if ($intent_options) :

							?>
							<div class="form-group form-select">

								<select name="intent" id="intent" class="form-control">
									<?php foreach ($intent_options as $key => $value) : ?>
										<option value="<?php echo esc_attr(str_replace(' ', '-', strtolower($value))); ?>">
											<?php echo esc_attr(trim($value)); ?></option>
									<?php
									endforeach;

									?>
								</select>
							</div>
						<?php

						endif;
					endif;

					if (!empty($instance['message_label'])) :

						?>
						<div class="form-group">
							<textarea name="message" id="message" class="form-control" rows="8" required="required"><?php echo (isset($_POST['message']) ? esc_textarea($_POST['message']) : ''); ?></textarea>
							<label for="message"><?php echo esc_html($instance['message_label']); ?></label>
						</div>
					<?php

					endif;

					wp_nonce_field('contact-form-widget');

					?>
					<input type="hidden" name="submit" id="submit" value="1">
					<?php if (!empty($instance['submit_label'])) : ?>
						<button type="submit" class="btn btn-primary btn-submit"><?php echo esc_html($instance['submit_label']); ?></button>
					<?php endif; ?>
				</form>
			<?php

			endif;

			echo wp_kses_post($args['after_widget']);

			?>
			<div class="col-md-12 col-lg-3">
				<?php

				// Don't show Locations sidebar when contact form data is successfully submitted
				if (false === isset($_POST['submit'])) :
					get_template_part(SNIPPETS_DIR . '/sidebars/locations');
				endif;

				?>
			</div>
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
public function form($instance)
{

	$title         = !empty($instance['title']) ? $instance['title'] : '';
	$description   = !empty($instance['description']) ? $instance['description'] : '';
	$name_label    = !empty($instance['name_label']) ? $instance['name_label'] : __('Company name', 'keitaro');
	$email_label   = !empty($instance['email_label']) ? $instance['email_label'] : __('Business email', 'keitaro');
	$intent_list   = !empty($instance['intent_list']) ? $instance['intent_list'] : __('Intent...', 'keitaro');
	$message_label = !empty($instance['message_label']) ? $instance['message_label'] : __('How may we help you...', 'keitaro');
	$send_to       = !empty($instance['sent_to']) ? $instance['sent_to'] : get_option('admin_email');
	$submit_label  = !empty($instance['submit_label']) ? $instance['submit_label'] : __('Contact us', 'keitaro');
	$thank_you     = !empty($instance['thank_you']) ? $instance['thank_you'] : __("Thank you for contacting us. You'll hear from us shortly.", 'keitaro');

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
		<label for="<?php echo esc_attr($this->get_field_id('sent_to')); ?>"><?php esc_attr_e('Recipient email address:', 'keitaro'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('sent_to')); ?>" name="<?php echo esc_attr($this->get_field_name('sent_to')); ?>" type="text" value="<?php echo esc_attr($send_to); ?>">
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('thank_you')); ?>"><?php esc_attr_e('Message sent notice:', 'keitaro'); ?></label>
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
public function update($new_instance, $old_instance)
{

	$instance = $old_instance;

	$instance['title']         = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
	$instance['description']   = (!empty($new_instance['description'])) ? strip_tags($new_instance['description']) : '';
	$instance['name_label']    = (!empty($new_instance['name_label'])) ? strip_tags($new_instance['name_label']) : '';
	$instance['email_label']   = (!empty($new_instance['email_label'])) ? strip_tags($new_instance['email_label']) : '';
	$instance['intent_list']   = (!empty($new_instance['intent_list'])) ? strip_tags($new_instance['intent_list']) : '';
	$instance['message_label'] = (!empty($new_instance['message_label'])) ? strip_tags($new_instance['message_label']) : '';
	$instance['sent_to']       = (!empty($new_instance['sent_to'])) ? strip_tags($new_instance['sent_to']) : get_option('admin_email');
	$instance['submit_label']  = (!empty($new_instance['submit_label'])) ? strip_tags($new_instance['submit_label']) : '';
	$instance['thank_you']     = (!empty($new_instance['thank_you'])) ? strip_tags($new_instance['thank_you']) : '';

	return $instance;
}
}
