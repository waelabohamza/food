<?php
include "../connect.php" ;

$userid   =  $_POST['userid'] ;
$taxiid   =  $_POST['taxiid'];
$lat      =  $_POST['lat'] ;
$long     =  $_POST['long'] ;
$destlat  =  $_POST['destlat'] ;
$destlong =  $_POST['destlong'] ;
$price    =  $_POST['price'] ;
$distance =  $_POST['distance'] ;
// $tokentaxi = $_POST['tokentaxi'] ;



$stmt = $con->prepare('INSERT INTO `orderstaxi`( `orderstaxi_user`,
                                                  `orderstaxi_taxi`,
                                                  `orderstaxi_lat`,
                                                  `orderstaxi_long`,
                                                  `orderstaxi_lat_dest`,
                                                  `orderstaxi_long_dest`,
                                                  `orderstaxi_price`,
                                                  `orderstaxi_distancekm`
                                                )
                       VALUES (:us   , :tax , :lat , :long , :dlat , :dlong , :pr  , :di )
                     ') ;

$stmt->execute(
   array(
     ':us'    => $userid ,
     ':tax'   => $taxiid ,
     ':lat'   => $lat ,
     ':long'  => $long ,
     ':dlat'  => $destlat ,
     ':dlong' => $destlong ,
     ':di'    => $distance ,
     ':pr'    => $price
   )
) ;

$count = $stmt->rowCount() ;

if ($count > 0 ) {

   removeMoneyById("users" , "user_balance"  ,  $price , "user_id" , $userid ) ;
   bill($price , $userid  , 0  , "طلب تكسي" , "تحويل الى حساب التكسي") ;  
   addMoneyById("taxi" ,  "taxi_balance"  ,  $price , "taxi_id" , $taxiid) ;


    $title = "هام"  ;
    $message = "يوجد طلب بانتظار الموافقة"  ;
    // sendGCM( $title , $message ,  $tokentaxi, "id", "orderswait") ;
    sendNotifySpecificTaxi($taxiid , $title , $message  , "id" , "orderswait" ) ;
    $title = "تنبيه"  ;
    $message = "تم ارسال طلبك بنجاح والان بانتظار موافقة التكسي"  ;
    sendNotifySpecificUser($userid , $title , $message  , "id" , "orderswaittaxi" ) ;

    echo json_encode(array("status" => "success")) ;


  }else {
    
  echo json_encode(array("status" => "faild")) ;
  
}

?>
