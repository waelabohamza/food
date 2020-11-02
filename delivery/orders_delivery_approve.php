<?php
include "../connect.php" ;

$deliveryid   = $_POST['deliveyid'] ;
$ordersid     = $_POST['ordersid'] ;
$stmt = $con->prepare("UPDATE orders SET orders_delivery = ?  , orders_status = 1   WHERE orders_id  = ? ") ;
$stmt->execute(array($deliveryid  ,  $ordersid )) ;
$count = $stmt->rowCount() ;
if ($count > 0 ) {
   echo json_encode( array('status' => 'success' ));
}else {
   echo json_encode( array('status' => 'faild'));
}


?>
