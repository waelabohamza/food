<?php
include "../connect.php" ;

$orderid = $_POST['orderid']  ;
$userid  =  $_POST['userid']  ;
$resid   =  $_POST['resid']   ;

$stmt = $con->prepare("UPDATE orders SET orders_status = 3 WHERE orders_id = ?") ;

$stmt->execute(array($orderid)) ;

$count = $stmt->rowCount() ;

if ($count > 0 ) {

  echo json_encode(array("status" => "success")) ;
  $title       =   "TalabGoFoodDelivery"  ;
  $message     =   "تم استلام الطلبية بنجاح" ;
  sendNotifySpecificUser($userid , $title ,  $message , "id" , "ordersdone" ) ;
  $title       =   "TalabGoRestaurants"  ;
  $message     =   "تم توصيل الطلبية رقم "  . $orderid . " بنجاح  " ;
  sendNotifySpecificRes($resid ,  $title ,  $message ,  "id" , "orders" ) ;
}else {

  echo json_encode(array("status" => "faild")) ;

}


?>
