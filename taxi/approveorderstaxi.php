<?php
include  "../connect.php" ;

$orderid = $_POST['ordersid'] ;

$tokenuser = $_POST['tokenuser'] ;

$stmt = $con->prepare("UPDATE orderstaxi SET orderstaxi_status = 1 WHERE orderstaxi_id = ? ") ;

$stmt->execute(array($orderid)) ;

$count = $stmt->rowCount() ;

if ($count > 0) {

$title = "هام";

$message = "تم الموافقة على طلبك  من قبل التكسي والان هو على الطريق"  ;

sendGCM( $title , $message ,  $tokenuser , "page" , "approveorders");

echo json_encode(array("status" => "success")) ;

}else {

echo json_encode(array("status" => "faild")) ;

}

?>
