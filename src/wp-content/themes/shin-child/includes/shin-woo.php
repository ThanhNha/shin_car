<?php

add_action('wp_head', 'header_callback');


function header_callback()
{
  $discount_rate = get_field('discount_rate', 'option');
  $adminEmail = get_field('sites_email', 'option');
  $sendEmail = get_field('send_email', 'option');

  echo '<script>
          var discountRate =' . $discount_rate . ';
          var adminEmail =  "' . $adminEmail . '";
          var sendEmail =  ' . $sendEmail . ';
        </script>';
}

add_action('wp_ajax_send_custom_email', 'send_custom_email');
add_action('wp_ajax_nopriv_send_custom_email', 'send_custom_email');
function send_custom_email()
{
  $to = sanitize_email($_POST['to']);
  $subject = sanitize_text_field($_POST['subject']);
  $message = wp_kses_post($_POST['message']);
  $headers = isset($_POST['headers']) ? sanitize_text_field($_POST['headers']) : '';
  $attachments = isset($_POST['attachments']) ? array_map('sanitize_text_field', $_POST['attachments']) : [];

  if (wp_mail($to, $subject, $message, $headers, $attachments)) {
    wp_send_json_success('Email sent successfully.');
  } else {
    wp_send_json_error('Failed to send email.');
  }
}
