 <?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $email    =  filter_var( $_POST['email'] , FILTER_SANITIZE_EMAIL) ;
  $password =  $_POST['password'] ;
  $token    =  $_POST['token'] ?? NULL ;

  $stmt = $con->prepare("SELECT * FROM restaurants WHERE res_email = ? AND res_password = ? And res_approve = 1") ;
  $stmt->execute(array($email , $password));

  $res = $stmt->fetch() ;

   $row = $stmt->rowcount()  ;

   if ($row > 0) {


     if ($token != NULL) {
        insertTokenRes( $res['res_id'] , $token) ;
        $title = "مرحبا";
        $message = "يمكنك من خلال هذا التطبيق اضافة الوجبات لديك مما يساعدك في زيادة الطلب على مطعمك";
        sendNotifySpecificRes($res['res_id']   , $title , $message , "id" , "name" );
     }

     echo json_encode(array('message' => $res, 'status' => "success"));
   }else {
     echo json_encode (array('status' => "faild" , 'email' => $email  , 'password' => $password) );
 }


}
?>
