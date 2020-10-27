<?php

include "../connect.php" ;
$phone =  filterSan($_POST['phone'] , "number") ;
$units =  $_POST['units'] ;
$userid = $_POST['userid'] ;
$stmt = $con->prepare("UPDATE users SET  `user_balance` = $units  +  `user_balance`  WHERE `user_phone` = ? ") ;
$stmt->execute(array($phone)) ;

$count = $stmt->rowCount() ;

if ($count > 0 ) {
  $stmt2 = $con->prepare("UPDATE users SET  `user_balance` = `user_balance` - $units       WHERE `user_id` = ? ") ;
  $stmt2->execute(array($userid)) ;
 echo json_encode(array("status" => "success"))  ;
}else {
  echo json_encode(array("status" => "faild"))  ;
}
?>
