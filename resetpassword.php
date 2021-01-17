<?php
// For Send Mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'mail/autoload.php';
// End ================
 include "connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){
 $email = filterSan($_POST['email'] , "email");
 $sql = "SELECT * FROM users WHERE email = ?";
 $stmt = $con->prepare($sql) ;
 $stmt->execute(array($email)) ;
 $users  = $stmt->fetch(PDO::FETCH_ASSOC)  ;
 $count = $stmt->rowCount() ;
   if ($count > 0 ){

     $code  = rand(10000,99999) ;
     $stmt2 = $con->prepare("UPDATE `users` SET  `verfiycode` = ? WHERE email = ? ") ;
     $stmt2->execute(array($code , $email)) ;
     $count2 = $stmt2->rowCount()  ;
     if ($count2 > 0 ) {
          echo json_encode( array('status' =>'success' ,'users' => $users )) ;
         // send mail
         $mail = new PHPMailer(true);
         $mail->SMTPDebug = 0;                      // Enable verbose debug output
         $mail->isSMTP();                                            // Send using SMTP
         $mail->Host       = 'mail.almotorkw.com';                    // Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
         $mail->Username   = 'shady@almotorkw.com';                     // SMTP username
         $mail->Password   = '2afIM^L)+,*C';                               // SMTP password
         $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
         $mail->Port       = 587;
         $mail->CharSet = 'UTF-8';
         $mail->SMTPOptions = array(
         'ssl' => array(
         'verify_peer' => false,
         'verify_peer_name' => false,
         'allow_self_signed' => true
         )
         );
           $mail->addAddress($email);
           $mail->setFrom('shady@almotorkw.com', 'wael');
           $mail->isHTML(true);                                  // Set email format to HTML
           $mail->Subject =   "اعادة تعيين كلمة المرور";
           $mail->Body    =   "رمز التحقق <strong>"  .  $code . "</strong>" ;
           $mail->send();
         // End Send Mail
     }
   }else{
     echo json_encode(array("status" => "faild") ) ;
   }
}else {
 echo "page not found" ;
}
?>
