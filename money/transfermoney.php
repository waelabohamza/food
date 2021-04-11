<?php
include "../connect.php" ;
$phone =  filterSan($_POST['phone'] , "number");
$get = getTokenByPhone($phone);
// $token = $get['token'] ; 
$userid = $get['user_id'] ; 
$units =  $_POST['units'] ;
$stmt = $con->prepare("UPDATE users SET  `user_balance` = $units + `user_balance`   WHERE `user_phone` = ? ") ;
$stmt->execute( array( $phone)) ;
$count = $stmt->rowCount() ;
if ($count > 0 ) {
bill($units , $userid , "1" , " تحويل مالي" , " تم تحويل رصيد من  TalabPay") ; 
 echo json_encode(array("status" => "success" , "token" => $token))  ;
 $title = "TalabGoFoodDelivery" ;
 $message = " تم تحويل رصيد " . $units . " دينار من قبل TalabPay " ;
 sendNotifySpecificUser($userid  , $title , $message , "" , "")  ;
}else {
  echo json_encode(array("status" => "faild"))  ;
}
?>
