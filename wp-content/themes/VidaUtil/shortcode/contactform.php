<?php
	/*
	Plugin Name: Simple Contact Form Shortcode
	Plugin URI: http://wp.tutsplus.com/author/barisunver/
	Description: A simple contact form for simple needs. Usage: <code>[contact email="your@email.address"]</code>
	Version: 1.0
	Author: Barış Ünver
	Author URI: http://beyn.org/
	*/

// function to get the IP address of the user
function wptuts_get_the_ip() {
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	else {
		return $_SERVER["REMOTE_ADDR"];
	}
}

// the shortcode
function wptuts_contact_form_sc($atts) {
	extract(shortcode_atts(array(
		"email"         => get_bloginfo('admin_email'),
		"subject"       => '',
		"label_name"    => 'Your Name',
		"label_email"   => 'Your E-mail Address',
		"label_subject" => 'Subject',
		"label_message" => 'Your Message',
		"label_submit"  => 'Submit',
		"error_empty"   => 'Please fill in all the required fields.',
		"error_noemail" => 'Please enter a valid e-mail address.',
		"success"       => 'Thanks for your e-mail! We\'ll get back to you as soon as we can.'
	), $atts));

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$error = false;
		$required_fields = array("your_name", "email", "message", "subject");

		foreach ($_POST as $field => $value) {
			if (get_magic_quotes_gpc()) {
				$value = stripslashes($value);
			}
			$form_data[$field] = strip_tags($value);
		}

		foreach ($required_fields as $required_field) {
			$value = trim($form_data[$required_field]);
			if(empty($value)) {
				$error = true;
				$result = $error_empty;
			}
		}

		if(!is_email($form_data['email'])) {
			$error = true;
			$result = $error_noemail;
		}

		if ($error == false) {
			$email_subject = "[" . get_bloginfo('name') . "] " . $form_data['subject'];
			$email_message = $form_data['message'] . "\n\nIP: " . wptuts_get_the_ip();
			$headers  = "From: ".$form_data['your_name']." <".$form_data['email'].">\n";
			$headers .= "Content-Type: text/plain; charset=UTF-8\n";
			$headers .= "Content-Transfer-Encoding: 8bit\n";
			wp_mail($email, $email_subject, $email_message, $headers);
			$result = $success;
			$sent = true;
		}
	}

	if($result != "") {
		$info = '<div class="info">'.$result.'</div>';
	}
	$email_form = '<form class="contact-form" method="post" action="'.get_permalink().'">
		<div>
			<label for="cf_name">'.$label_name.':</label>
			<input type="text" name="your_name" id="cf_name" size="50" maxlength="50" value="'.$form_data['your_name'].'" />
		</div>
		<div>
			<label for="cf_email">'.$label_email.':</label>
			<input type="text" name="email" id="cf_email" size="50" maxlength="50" value="'.$form_data['email'].'" />
		</div>
		<div>
			<label for="cf_subject">'.$label_subject.':</label>
			<input type="text" name="subject" id="cf_subject" size="50" maxlength="50" value="'.$subject.$form_data['subject'].'" />
		</div>
		<div>
			<label for="cf_message">'.$label_message.':</label>
			<textarea name="message" id="cf_message" cols="50" rows="15">'.$form_data['message'].'</textarea>
		</div>
		<div>
			<input type="submit" value="'.$label_submit.'" name="send" id="cf_send" />
		</div>
	</form>';
	
	if($sent == true) {
		return $info;
	} else {
		return $info.$email_form;
	}
} add_shortcode('contact', 'wptuts_contact_form_sc');

?>