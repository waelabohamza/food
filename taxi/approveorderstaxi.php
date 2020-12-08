<?php
include  "../connect.php" ;

$orderid = $_POST['ordersid']   ;

$userid = $_POST['userid']      ;

$lat = $_POST['lat']            ;

$long = $_POST['long']          ;

$destlat = $_POST['destlat']    ;

$destlong = $_POST['destlong']  ;

$taxiid = $_POST['taxiid'] ;

$infodelivery = array() ;

$infodelivery['ordersid'] = $orderid ;
$infodelivery['userid']   = $userid ;
$infodelivery['lat']      = $lat ;
$infodelivery['long']     = $long ;
$infodelivery['destlat']  = $destlat ;
$infodelivery['destlong'] = $destlong ;
$infodelivery['taxiid']   = $taxiid ;




$stmt = $con->prepare("UPDATE orderstaxi SET orderstaxi_status = 1 WHERE orderstaxi_id = ? ") ;

$stmt->execute(array($orderid)) ;

$count = $stmt->rowCount() ;

if ($count > 0) {

$title = "هام";

$message = "تم الموافقة على طلبك  من قبل التكسي والان هو على الطريق"  ;

sendNotifySpecificUser($userid , $title , $message  , $infodelivery , "approveorderstaxi" ) ;

echo json_encode(array("status" => "success")) ;

}else {

echo json_encode(array("status" => "faild")) ;

}

?>
