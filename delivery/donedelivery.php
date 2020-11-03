<?php
include "../connect.php" ;

$orderid = $_POST['orderid'] ;

$stmt = $con->prepare("UPDATE orders SET orders_status = 3 WHERE orders_id = ?") ;

$stmt->execute(array($orderid)) ;

$count = $stmt->rowCount() ;

if ($count > 0 ) {

  echo json_encode(array("status" => "success")) ;

}else {

  echo json_encode(array("status" => "faild")) ;

}


?>
