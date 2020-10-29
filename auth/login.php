 <?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $and = null ;
  $email    = filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL ) ;
  $password =  $_POST['password'] ;
  if (isset($_POST['role'])){
    $role = $_POST['role']  ;
    $and =  "AND role = '$role' " ;
  }
  $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND password = ? $and") ;
  $stmt->execute(array($email , $password));
  $user = $stmt->fetch() ;
   $row = $stmt->rowcount()  ;
   if ($row > 0) {
       $id        = filterSan($user['user_id'] , "number") ;
       $username  = filterSan($user['username']) ;
       $email     = filterSan( $user['email']) ;
       $password  = $user['password'] ;
       $balance  = filterSan($user['user_balance'] , "number") ;
       $phone  = filterSan($user['user_phone'], "number")  ;
       echo json_encode(array('id' => $id , 'username' => $username ,'email' => $email  , 'balance' => $balance   , 'phone' => $phone ,'password' => $password , 'status' => "success"));
   }else {
     echo json_encode (array('status' => "faild" , 'email' => $email  , 'password' => $password) );
   }
}
?>
