<?php

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $emailtarget = filterSan($_POST['email'] , "email") ;
  $title = filterSan($_POST['title']) ;
  $content = filterSan($_POST['content']) ;

  // Import PHPMailer classes into the global namespace
  // These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  // use PHPMailer\PHPMailer\Exception;
  // Load Composer's autoloader
  require 'mail/autoload.php';
  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);
  try {
      //Server settings
      $mail->SMTPDebug = 0;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'mail.talabpay.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'resetpassword@talabpay.com';                     // SMTP username
      $mail->Password   = '2_f12*5h(Z6Z';                               // SMTP password
      $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;
      $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
      );                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
      //Recipients
      $mail->setFrom('resetpassword@talabpay.com', 'talabpay');
      // $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
      $mail->addAddress($emailtarget);               // Name is optional
      // $mail->addReplyTo('info@example.com', 'Information');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');
      // Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject =   $title ;
      $mail->Body    =   $content;
      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->send();
      echo 'Message has been sent';
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
}
