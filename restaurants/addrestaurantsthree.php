<?php

include "../connect.php" ;
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $country        = $_POST['country'];
  $area           = $_POST['area'];
  $street         = $_POST['street'];

  $resemail          = $_POST['resemail'] ;

  $stmt = $con->prepare("UPDATE `restaurants` SET `res_country` = ? , `res_area` = ? , `res_street` = ?     WHERE `res_email` = ? ") ;

  $stmt->execute(array($country , $area ,  $street , $resemail));

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
