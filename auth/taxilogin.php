<?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){


 $email    = filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL ) ;
 $password =  $_POST['password'] ;
 $token = $_POST['token']  ;



 $stmt = $con->prepare("SELECT * FROM taxi WHERE taxi_email = ? AND taxi_password = ?  ") ;
 $stmt->execute(array($email , $password));
 $user = $stmt->fetch() ;
 $row = $stmt->rowcount()  ;



  if ($row > 0) {


    $stmt2 = $con->prepare(" UPDATE `taxi` SET `taxi_token`= ?  WHERE `taxi_id` = ? ") ;
    $stmt2->execute(array($token , $user['taxi_id'])) ;

      $id        = filterSan($user['taxi_id'] , "number") ;
      $username  = filterSan($user['taxi_username']) ;
      $email     = filterSan( $user['taxi_email']) ;
      $password  = $user['taxi_password'] ;
      $balance  = filterSan($user['taxi_balance'] , "number") ;
      $phone  = filterSan($user['taxi_phone'], "number")  ;



      echo json_encode(array('token' => $token , 'id' => $id , 'username' => $username ,'email' => $email  , 'balance' => $balance   , 'phone' => $phone ,'password' => $password  ,  'status' => "success"));
  }else {
    echo json_encode (array('status' => "faild" , 'email' => $email  , 'password' => $password , 'token' =>  $token) );
  }
}
?>
