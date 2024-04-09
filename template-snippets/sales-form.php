<?php

/**
 * Template snippet for the Sales form section
 *
 * @link https://github.com/keitaroinc/keitaro-theme
 *
 * @package WordPress
 * @subpackage Keitaro
 */


/**
 * Based on https://www.binarymoon.co.uk/2010/03/akismet-plugin-theme-stop-spam-dead/
 *
 * @param [type] $content
 * @return void
 */
function keitaro_sales_form_check_spam($content)
{

	// innocent until proven guilty
	$is_spam = false;

	$content = (array) $content;

	if (function_exists('akismet_init')) {

		$wpcom_api_key = get_option('wordpress_api_key');

		if (!empty($wpcom_api_key)) {

			global $akismet_api_host, $akismet_api_port;

			// set remaining required values for akismet api
			$content['blog'] = get_option( 'home' );
			$content['user_ip'] = $_SERVER['REMOTE_ADDR'];
			$content['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$content['referrer'] = $_SERVER['HTTP_REFERER'];
			$content['permalink'] = get_permalink();
			$content['comment_type'] = 'contact-form';

			$query_string = '';

			foreach ($content as $key => $data) {
				if (!empty($data)) {
					$query_string .= $key . '=' . urlencode(stripslashes($data)) . '&';
				}
			}

			$response = akismet_http_post($query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port);

			if ($response[1] == 'true') {
				// update_option('akismet_spam_count', get_option('akismet_spam_count') + 1);
				$is_spam = $response[1];
			}
		}
	}

	return $is_spam;
}

$tag_id = 'sales-tag';

$email_sent     = false;
$autoreply_sent = false;

$send_to = get_option('keitaro_settings')['sales_contact'] ?? false;

if (isset($_GET['salesFormSubmitted']) && wp_verify_nonce($_REQUEST['_wpnonce'], 'keitaroSalesForm')) :
	$sender            = isset($_POST['salesFormName']) ? trim(esc_html($_POST['salesFormName'])) : '';
	$sender_email      = isset($_POST['salesFormEmail']) ? trim(esc_html($_POST['salesFormEmail'])) : '';
	$phone             = isset($_POST['salesFormPhone']) ? trim($_POST['salesFormPhone']) : '';
	$subject           = sprintf('%1$s %2$s', __('New message from', 'keitaro'), trim(esc_html($sender)));
	$subject_autoreply = sprintf('%1$s %2$s', __('Thank you for contacting', 'keitaro'), get_bloginfo('name'));
	$consent           = isset($_POST['salesFormConsent']) ? $_POST['salesFormConsent'] : false;
	$submitted_message = isset($_POST['salesFormMessage']) ? str_replace("\r\n", '<br>', trim(esc_html($_POST['salesFormMessage']))) : '';

	$spam_check['comment_type'] = 'contact-form';
	$spam_check['comment_author'] = $sender;
	$spam_check['comment_author_email'] = $sender_email;
	$spam_check['comment_content'] = $submitted_message;

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . get_bloginfo('name') . ' <' . $send_to . '>',
	);

	$body = join(
		'<br>',
		array(
			__('Hello,', 'keitaro') . '<br>',
			// translators: %1$s stands for the Sender name, %2$s for the Sender email address and %3$s for the URL of the form page
			sprintf(__('%1$s submitted the following message from %2$s though the contact form on %3$s.', 'keitaro'), $sender, $sender_email, get_the_permalink()) . '<br>',
			'<div style="background-color: #f2f2f2; padding: 30px;">' . $submitted_message . '</div>',
			// translators: %1$s stands for the Sender name, %2$s for the Sender phone number
			sprintf(__('%1$s\'s phone number is <strong>%2$s</strong>.', 'keitaro'), $sender, $phone) . '<br>',
			// translators: %1$s stands for 'wants' or 'doesn't want' based on the user preference. %2$s stands for the WordPress website name.
			sprintf(__('The contact <strong>%1$s to receive</strong> marketing communication from %2$s.', 'keitaro'), $consent ? __('wants', 'keitaro-contact-form') : __("doesn't want", 'keitaro'), get_bloginfo('name')) . '<br>',
			__('Regards,', 'keitaro'),
			// translators: %s stands for get_bloginfo('name')
			sprintf(__('Keitaro', 'keitaro'), get_bloginfo('name')),
		)
	);

	$body_autoreply = join(
		'<br>',
		array(
			__('Hello,', 'keitaro') . '<br>',
			// translators: %s stands for get_bloginfo('name')
			sprintf(__('Thank you for contacting us at %s. We are just reaching out to confirm that we received your message. We will respond back as soon as possible.', 'keitaro'), get_bloginfo('name')) . '<br>',
			__('Kind Regards,', 'keitaro'),
			get_bloginfo('name') . '<br>',
			esc_url(get_home_url()),
			$send_to,
		)
	);
endif;

if (get_the_terms(get_the_ID(), $tag_id)) :
?>
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<section id="salesForm" class="p-5 my-5 bg-light rounded rounded-lg">
				<?php the_terms(get_the_ID(), $tag_id, '<h2 class="mt-3 text-center has-text-align-center">How may we help you with ', ' / ', '?</h2>'); ?>
				<form method="POST" action="<?php echo esc_url(wp_nonce_url(add_query_arg('salesFormSubmitted', true, get_the_permalink()))); ?>#salesForm">
					<?php

					if ((isset($_GET['salesFormSubmitted'])) && wp_verify_nonce($_REQUEST['_wpnonce'], 'keitaroSalesForm')) :

						try {
							// Check email content with Akismet before sending.
							if ('true' === keitaro_sales_form_check_spam($spam_check)) :
								throw new Exception(esc_html__("Seems like you are trying to submit spam. Sorry, that's not allowed.", 'keitaro'));
							else :

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
									throw new Exception(__("Something's wrong. The auto-respond email message was not delivered to sender.", 'keitaro'));
								endif;

							endif;
						} catch (Exception $e) {
					?>
							<div class="mt-5 alert alert-danger">
								<?php echo wp_kses_post($e->getMessage()), "\n"; ?>
							</div>
						<?php
						}

						if ($email_sent && $autoreply_sent) :
						?>
							<div class="alert alert-success">
								<?php esc_html_e('Thank you! We will contact you as soon as possible.', 'keitaro'); ?>
							</div>
					<?php

						endif;
					endif;
					?>
					<div class="form-group">
						<label for="salesFormName">Name</label>
						<input class="form-control" required="required" type="text" name="salesFormName" id="salesFormName" />
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="salesFormEmail">Email</label>
								<input class="form-control" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="required" type="email" name="salesFormEmail" id="salesFormEmail" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="salesFormPhone">Phone</label>
								<input class="form-control" minlength="11" type="tel" placeholder="+1-123-456-7890" pattern="+[0-9]{11}" name="salesFormPhone" id="salesFormPhone" />
							</div>
						</div>
					</div>
					<label for="salesFormMessage">Message</label>
					<textarea class="form-control" name="salesFormMessage" id="salesFormMessage" minlength="30" maxlength="3000" required rows="8"></textarea>
					<?php wp_nonce_field('keitaroSalesForm'); ?>
					<div class="mt-5 d-flex flex-column align-items-center">
						<div class="form-group form-check">
							<input type="checkbox" checked="checked" class="form-check-input" name="salesFormConsent" id="salesFormConsent">
							<label class="form-check-label font-weight-bolder" for="salesFormConsent">I agree to receive marketing communication from Keitaro</label>
						</div>
						<p class="mb-0 text-center"><small>By submitting this form you agree to Keitaro using your personal data in accordance with the General Data Protection Regulation. You can unsubscribe at any time. For information about our privacy practices, please visit our <a href="https://www.keitaro.com/privacy-policy/" rel="bookmark">Privacy Policy</a> page.</small></p>
						<button class="btn btn-primary mt-4" type="submit">Send</button>
					</div>
				</form>
			</section>
		</div>
	</div>
<?php endif; ?>
