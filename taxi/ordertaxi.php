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
$driver   =  $_POST['driver'] ;


$stmt = $con->prepare('INSERT INTO `orderstaxi`( `orderstaxi_user`,
                                                  `orderstaxi_driver`,
                                                  `orderstaxi_taxi`,
                                                  `orderstaxi_lat`,
                                                  `orderstaxi_long`,
                                                  `orderstaxi_lat_dest`,
                                                  `orderstaxi_long_dest`,
                                                  `orderstaxi_price`,
                                                  `orderstaxi_distancekm`
                                                )
                       VALUES (:us , :dr , :tax , :lat , :long , :dlat , :dlong , :pr  , :di )
                     ') ;

$stmt->execute(
   array(
     ':us'    => $userid ,
     ':dr'    => $driver ,
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
  echo json_encode(array("status" => "success")) ;
}else {
  echo json_encode(array("status" => "faild")) ;
}

?>
