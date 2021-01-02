<?php

include "../connect.php" ;
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $country        = $_POST['country'];
  $area           = $_POST['area'];
  $street         = $_POST['street'];

  $timedelivery   =  filterSan($_POST['timedelivery'] , "number");
  $pricedelivery  =  filterSan($_POST['pricedelivery'] , "number");
  $description    = filterSan($_POST['description']);
  $type           = filterSan($_POST['type']);

  $getidbyname =  $con->prepare("SELECT catsres_id FROM catsres  WHERE catsres_name = ? ") ; 
  $getidbyname->execute(array($type)) ;
  $type = $getidbyname->fetchColumn() ;  

  $resemail          = $_POST['resemail'] ;

  $stmt = $con->prepare("UPDATE `restaurants` SET `res_country` = ? , `res_area` = ? , `res_street` = ? , `res_time_delivery` = ?  , `res_price_delivery` = ? , `res_description` = ? , `res_type` = ?   WHERE `res_email` = ? ") ;

  $stmt->execute(array($country , $area ,  $street ,  $timedelivery , $pricedelivery   , $description  , $type ,   $resemail));

  $count = $stmt->rowCount() ;

  if ($count > 0){

    echo json_encode(array("status" => "success"));




  }else {
    echo json_encode(array("status" => "faild"));
  }



}else {

  echo json_encode(array("status" => "request not post"));

}

?>
