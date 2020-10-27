 <?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $email    = filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL) ;
  $password =  $_POST['password'] ;

  $stmt = $con->prepare("SELECT * FROM restaurants WHERE res_email = ? AND res_password = ? And res_approve = 1") ;
  $stmt->execute(array($email , $password));

  $user = $stmt->fetch() ;

   $row = $stmt->rowcount()  ;

   if ($row > 0) {
       // $id        = $user['res_id'] ;
       // $username  = $user['res_name'] ;
       // $email     = $user['res_email'] ;
       // $password  = $user['res_password'] ;
       // $password  = $user['res_password'] ;
       echo json_encode(array('message' => $user, 'status' => "success"));
   }else {
     echo json_encode (array('status' => "faild" , 'email' => $email  , 'password' => $password) );
 }


}
?>
