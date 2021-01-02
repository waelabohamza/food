<?php
include "../connect.php" ;

$orderid = $_POST['orderid']  ;
$userid  =  $_POST['userid']  ;
$resid   =  $_POST['resid']   ;
$typeorder = $_POST['typeorder'] ; 
$stmt = $con->prepare("UPDATE orders SET orders_status = 3 WHERE orders_id = ?") ;

$stmt->execute(array($orderid)) ;

$count = $stmt->rowCount() ;

if ($count > 0 ) {

  echo json_encode(array("status" => "success")) ;

  if ($typeorder == "delivery"){

  $title       =   "TalabGoFoodDelivery"  ;
  $message     =   "تم استلام الطلبية بنجاح" ;
  sendNotifySpecificUser($userid , $title ,  $message , "id" , "ordersdone" ) ;
  $title       =   "TalabGoRestaurants"  ;
  $message     =   "تم توصيل الطلبية رقم "  . $orderid . " بنجاح  " ;
  sendNotifySpecificRes($resid ,  $title ,  $message ,  "id" , "orders" ) ;

  
}elseif ($typeorder == "tableqrcode" ) {

    
    $title       =   "TalabGoFoodDelivery"  ;
    $message     =   "نتمنى ان تكون قد نالت الوجبة اعجابك " ;
    sendNotifySpecificUser($userid , $title ,  $message , "id" , "ordersdone" ) ;
    $title       =   "TalabGoRestaurants"  ;
    $message     =    "تم تسكير الطاولة بنجاح" ; 
    sendNotifySpecificRes($resid ,  $title ,  $message ,  "id" , "orders" ) ;

}
else {
    $title       =   "تنبيه"  ;
    $message     =   "تم استلام الطلبية بنجاح" ;
    sendNotifySpecificUser($userid , $title ,  $message , "id" , "ordersdone" ) ;
    sendNotifySpecificRes($resid ,  $title ,  $message ,  "id" , "orders" ) ;
}

}else {

  echo json_encode(array("status" => "faild")) ;

}


?>
