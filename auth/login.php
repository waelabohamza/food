 <?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $and = null ;
  $email    = filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL ) ;
  $password =  $_POST['password'] ;




  // $token = isset($_POST['token']) ?  $_POST['token'] : NULL  ;
  $token = $_POST['token'] ?? NULL ;

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

     // $stmt2 = $con->prepare(" UPDATE `users` SET `user_token`= ?  WHERE `user_id` = ? ") ;
     // $stmt2->execute(array($token , $user['user_id'])) ;


       $id  = filterSan($user['user_id'] , "number") ;

       if ($token != NULL ) {
          insertTokenUser($id ,$token);
          $title = "مرحبا"   ;
          if (isset($role) && $role == "3"){
            $message = " يمكنك من خلال هذا التطبيق الحصول على فرصة عمل في ايصال الطلبات" ;
          }elseif (isset($role) && $role == "1"){
              $message = "يمكنك من خلال لوحة التحكم مراقبة جميع العمليات التي تجري على التطبيق" ;
          }
          else {
            $message = "التطبيق الاول في الكويت يمكنك من خلاله طلب ما تريد تكسي  او طعام والكثير" ;
          }
          sendGCM($title  , $message, $token , $id , "login");
          insertNotifySpecifcCatInDatabase($title , $message , 2 , $id ) ; 
       }



       $username  = filterSan($user['username']) ;
       $email     = filterSan( $user['email']) ;
       $password  = $user['password'] ;
       $balance  = filterSan($user['user_balance'] , "number") ;
       $phone  = filterSan($user['user_phone'], "number")  ;
       $deliverres = $user['delivery_res'] ;


       echo json_encode(array('id' => $id , 'username' => $username ,'email' => $email  , 'balance' => $balance   , 'phone' => $phone ,'password' => $password  , 'res' => $deliverres , 'status' => "success"));
   }else {
     echo json_encode (array('status' => "faild" , 'email' => $email  , 'password' => $password) );
   }
}
?>
