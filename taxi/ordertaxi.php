<?php
include "../connect.php" ;

$userid   = $_POST['userid'] ;
$taxiid   =  "0" ;
$lat      =  $_POST['lat'] ;
$long     =  $_POST['long'] ;
$destlat  =  $_POST['dlat'] ;
$destlong =  $_POST['dlong'] ;
$price    =  $_POST['price'] ;


$stmt = $con->prepare("INSERT INTO `orderstaxi`( `orderstaxi_user`, `orderstaxi_taxi`, `orderstaxi_lat`, `orderstaxi_long`, `orderstaxi_lat_dest`, `orderstaxi_long_dest`, `orderstaxi_price`)
                       VALUES ( `:us` , `:tax` , `:lat` , `:long` , `:dlat` , `dlong`  , `:pr` ) ") ;
$stmt->execute(array(
  ":us"     => $userid  ,
  ":tax"    => $taxiid  ,
  ":lat"    => $lat    ,
  ":long"   => $long    ,
  ":dlat"   => $dlat    ,
  ":dlong"  => $dlong   ,
  ":pr"     => $price 
)) ;

?>
