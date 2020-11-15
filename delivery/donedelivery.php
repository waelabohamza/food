<?php
include "../connect.php" ;

$orderid = $_POST['orderid'] ;

$tokenuser = $_POST['tokenuser'] ;
$tokenres  = $_POST['tokenres'] ;

$stmt = $con->prepare("UPDATE orders SET orders_status = 3 WHERE orders_id = ?") ;

$stmt->execute(array($orderid)) ;

$count = $stmt->rowCount() ;

if ($count > 0 ) {
  echo json_encode(array("status" => "success" , "tokenuser" => $tokenuser)) ;

  $title       =   "TalabGoFoodDelivery"  ;
  $message     =   "تم استلام الطلبية بنجاح" ;
  sendGCM( $title , $message ,  $tokenuser , "id", "ordersdone")  ;

  $title       =   "TalabGoRestaurants"  ;
  $message     =   "تم توصيل الطلبية رقم "  . $orderid . " بنجاح  " ;
  sendGCM( $title , $message ,  $tokenres , "id", "orders")  ;



}else {

  echo json_encode(array("status" => "faild")) ;

}


?>
