<?php

include "../connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST"){


 $email    = filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL ) ;
 $password =  $_POST['password'] ;
 $token = $_POST['token'] ?? NULL  ;



 $stmt = $con->prepare("SELECT * FROM taxi WHERE taxi_email = ? AND taxi_password = ?  ") ;
 $stmt->execute(array($email , $password));
 $taxi = $stmt->fetch() ;
 $row = $stmt->rowcount()  ;

  if ($row > 0) {

    $id = filterSan($taxi['taxi_id'] , "number") ;

         if ($token != NULL){
            insertTokenTaxi( $id , $token) ;
            $title = "مرحبا";
            $message = "يمكنك من خلال هذا التطبيق  العمل كسائق ";
            sendNotifySpecificTaxi($id , $title , $message  , "id" , "welcome" ) ;
            insertNotifySpecifcCatInDatabase($title , $message , 0 , $id ) ; 
            
          }

      $username  = filterSan($taxi['taxi_username']) ;
      $email     = filterSan( $taxi['taxi_email']) ;
      $password  = $taxi['taxi_password'] ;
      $balance   = filterSan($taxi['taxi_balance'] , "number") ;
      $phone     = filterSan($taxi['taxi_phone'], "number")  ;



      echo json_encode(array('token' => $token , 'id' => $id , 'username' => $username ,'email' => $email  , 'balance' => $balance   , 'phone' => $phone ,'password' => $password  ,  'status' => "success"));

  }else {

    echo json_encode (array('status' => "faild" , 'email' => $email  , 'password' => $password , 'token' =>  $token) );

  }

}
?>
