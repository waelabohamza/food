

<?php

include "../connect.php" ;
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $country        = filterSan($_POST['country']);
  $area           = filterSan($_POST['area']);
  $street         = filterSan($_POST['street']);
  $timedelivery   = filterSan($_POST['timedelivery'] , "number");
  $pricedelivery  = filterSan($_POST['pricedelivery'] , "number");
  $description    = filterSan($_POST['description']);
  $type           = filterSan($_POST['type']);
  $resid          = filterSan($_POST['resid'] , "number") ;

  $stmt = $con->prepare("UPDATE `restaurants` SET `res_country` = ? , `res_area` = ? , `res_street` = ? , `res_time_delivery` = ?  , `res_price_delivery` = ? , `res_description` = ? , `res_type` = ?   WHERE `res_id` = ? ") ;

  $stmt->execute(array($country , $area ,  $street ,  $timedelivery , $pricedelivery   , $description  , $type ,   $resid));

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
