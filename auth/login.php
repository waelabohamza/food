 <?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $and = null ;
  $email    = filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL ) ;
  $password =  $_POST['password'] ;
  $token = $_POST['token']  ;


  if (isset($_POST['role'])){
    $role = $_POST['role']  ;
    $and =  "AND role = '$role' " ;
  }else {
    $and = "AND role = 0 " ;
  }
  $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND password = ? $and") ;
  $stmt->execute(array($email , $password));
  $user = $stmt->fetch() ;
   $row = $stmt->rowcount()  ;

   if ($row > 0) {

     $stmt2 = $con->prepare(" UPDATE `users` SET `user_token`= ?  WHERE `user_id` = ? ") ;
     $stmt2->execute(array($token , $user['user_id'])) ;


       $id        = filterSan($user['user_id'] , "number") ;
       $username  = filterSan($user['username']) ;
       $email     = filterSan( $user['email']) ;
       $password  = $user['password'] ;
       $balance  = filterSan($user['user_balance'] , "number") ;
       $phone  = filterSan($user['user_phone'], "number")  ;
       $deliverres = $user['delivery_res'] ;


       echo json_encode(array('token' => $token , 'id' => $id , 'username' => $username ,'email' => $email  , 'balance' => $balance   , 'phone' => $phone ,'password' => $password  , 'res' => $deliverres , 'status' => "success"));
   }else {
     echo json_encode (array('status' => "faild" , 'email' => $email  , 'password' => $password) );
   }
}
?>
