<?php

include "../connect.php" ;
$phone =  filterSan($_POST['phone'] , "number") ;
$units =  $_POST['units'] ;
$userid = $_POST['userid'] ;
$username = $_POST['username'] ;
$token = getTokenByPhone($phone);
$stmt = $con->prepare("UPDATE users SET  `user_balance` = $units  +  `user_balance`  WHERE `user_phone` = ? ") ;
$stmt->execute(array($phone)) ;
$count = $stmt->rowCount() ;
if ($count > 0 ) {
  $stmt2 = $con->prepare("UPDATE users SET  `user_balance` = `user_balance` - $units       WHERE `user_id` = ? ") ;
  $stmt2->execute(array($userid)) ;
 echo json_encode(array("status" => "success" , "tokensend" => $token))  ;
 $title = "TalabGoFoodDelivery" ;
 $message = "تم تحويل رصيد"  . $units . " دينار من قبل  "   . $username  .  " اليك " ;
 sendGCM($title , $message ,$token, "trabsfermoney" , "home");
 $title = "تنبيه" ;
 $message = "تم التحويل بنجاح"  ;
 sendNotifySpecificUser($userid , $title , $message  , "" , "donetransfermoney" ) ; 

}else {
  echo json_encode(array("status" => "faild"))  ;
}
?>
