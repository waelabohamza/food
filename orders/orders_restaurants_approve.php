<?php
include "../connect.php" ;

$ordersid     = $_POST['ordersid'] ;
$stmt = $con->prepare("UPDATE orders SET   orders_status = 1   WHERE orders_id  = ? ") ;
$stmt->execute(array($ordersid )) ;
$count = $stmt->rowCount() ;
if ($count > 0 ) {
   echo json_encode( array('status' => 'success' ));
}else {
   echo json_encode( array('status' => 'faild'));
}


?>
