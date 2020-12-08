<?php
include  "../connect.php" ;

$orderid    = $_POST['ordersid'] ;

$userid  = $_POST['userid'] ;


$stmt = $con->prepare("UPDATE orderstaxi SET orderstaxi_status = 3 WHERE orderstaxi_id = ? ") ;

$stmt->execute(array($orderid)) ;

$count = $stmt->rowCount() ;

if ($count > 0) {


  $title = "هام";

  $message = "تم التوصيل بنجاح"  ;

  sendNotifySpecificUser($userid , $title , $message  , $userid , "donedelivery") ;


echo json_encode(array("status" => "success")) ;

}else {

echo json_encode(array("status" => "faild")) ;

}

?>
