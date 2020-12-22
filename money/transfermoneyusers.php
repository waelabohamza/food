<?php

include "../connect.php" ;
$phone =  filterSan($_POST['phone'] , "number") ;
$units =  $_POST['units'] ;
$userid = $_POST['userid'] ;
$username = $_POST['username'] ;

$checkuser = $con->prepare("SELECT * FROM users WHERE user_phone = ?  ") ;
$checkuser->execute(array($phone)) ;
$countuser = $checkuser->rowCount() ;

if ($countuser > 0) {

  $get = getTokenByPhone($phone);
  $useridrecive = $get['userid'] ;



  $stmt = $con->prepare("UPDATE users SET  `user_balance` = $units  +  `user_balance`  WHERE `user_phone` = ? ") ;
  $stmt->execute(array($phone)) ;
  $count = $stmt->rowCount() ;
  if ($count > 0 ) {
    $stmt2 = $con->prepare("UPDATE users SET  `user_balance` = `user_balance` - $units       WHERE `user_id` = ? ") ;
    $stmt2->execute(array($userid)) ;
   echo json_encode(array("status" => "success"))  ;
   $title = "TalabGoFoodDelivery" ;
   $message = "تم تحويل رصيد"  . $units . " دينار من قبل  "   . $username  .  " اليك " ;
   sendNotifySpecificUser($useridrecive , $title , $message  , "" , "home" ) ;
   $title = "تنبيه" ;
   $message = "تم التحويل بنجاح"  ;
   sendNotifySpecificUser($userid , $title , $message  , "" , "donetransfermoney" ) ;
}
}else {
  echo json_encode(array("status" => "faild"))  ;
}
?>
