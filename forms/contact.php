<!-- <?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'contact@example.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

//   $contact->add_message( $_POST['name'], 'From');
//   $contact->add_message( $_POST['email'], 'Email');
//   $contact->add_message( $_POST['message'], 'Message', 10);

//   echo $contact->send();
// ?>
--------------------------- -->

<?php
  // 1. Destination Email (Change this to your email!)
  $receiving_email_address = 'your-email@example.com';

  // 2. Check if the form was actually submitted
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 3. Collect and sanitize input
    $name    = strip_tags(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST['subject']));
    $message = strip_tags(trim($_POST['message']));

    // 4. Basic Validation
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Please complete the form and try again.";
      exit;
    }

    // 5. Prepare Email Body
    $email_body = "You have received a new message from your website contact form.\n\n".
                  "Here are the details:\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Subject: $subject\n\n".
                  "Message:\n$message";

    // 6. Set Email Headers
    // Note: To avoid spam filters, it's best to send "From" your domain email
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email";

    // 7. Send the Email
    if (mail($receiving_email_address, $subject, $email_body, $headers)) {
      echo "OK"; // The JavaScript looks for "OK" to show the success message
    } else {
      echo "Could not send mail! Check your server's PHP mail settings.";
    }

  } else {
    echo "Invalid request.";
  }
?>