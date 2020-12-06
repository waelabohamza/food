<?php
include  "../connect.php" ;

$orderid    = $_POST['ordersid'] ;
$tokenuser  = $_POST['tokenuser'] ;


$stmt = $con->prepare("UPDATE orderstaxi SET orderstaxi_status = 3 WHERE orderstaxi_id = ? ") ;
$stmt->execute(array($orderid)) ;
$count = $stmt->rowCount() ;

if ($count > 0) {


  $title = "هام";

  $message = "تم التوصيل بنجاح"  ;

  sendGCM( $title , $message ,  $tokenuser , "page" , "donedelivery");

echo json_encode(array("status" => "success")) ;

}else {

echo json_encode(array("status" => "faild")) ;

}

?>
