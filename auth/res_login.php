 <?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $email    = filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL) ;
  $password =  $_POST['password'] ;
  $token = $_POST['token'] ; 

  $stmt = $con->prepare("SELECT * FROM restaurants WHERE res_email = ? AND res_password = ? And res_approve = 1") ;
  $stmt->execute(array($email , $password));

  $user = $stmt->fetch() ;

   $row = $stmt->rowcount()  ;

   if ($row > 0) {

     $stmt2 = $con->prepare(" UPDATE `restaurants` SET `res_token`= ?  WHERE `res_id` = ? ") ;
     $stmt2->execute(array($token , $user['res_id'])) ;

       echo json_encode(array('message' => $user, 'status' => "success"));
   }else {
     echo json_encode (array('status' => "faild" , 'email' => $email  , 'password' => $password) );
 }


}
?>
