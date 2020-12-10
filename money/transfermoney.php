<?php
include "../connect.php" ;
$phone =  filterSan($_POST['phone'] , "number");
$get = getTokenByPhone($phone);
$token = $get['token'] ; 
$userid = $get['userid'] ; 
$units =  $_POST['units'] ;
$stmt = $con->prepare("UPDATE users SET  `user_balance` = $units + `user_balance`   WHERE `user_phone` = ? ") ;
$stmt->execute( array( $phone)) ;
$count = $stmt->rowCount() ;
if ($count > 0 ) {
 echo json_encode(array("status" => "success" , "token" => $token))  ;
 $title = "TalabGoFoodDelivery" ;
 $message = "تم تحويل رصيد " . $units . " دينار من قبل TalabPay " ;
 sendGCM($title , $message ,$token, "trabsfermoney" , "home");
 insertNotifySpecifcCatInDatabase($title , $message , 2 , $userid) ; 
}else {
  echo json_encode(array("status" => "faild"))  ;
}
?>
