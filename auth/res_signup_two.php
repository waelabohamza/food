<?php

include "../connect.php" ;
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $lat    =   $_POST['lat']     ;
  $long   =   $_POST['long']     ;
  $resemail  =   $_POST['res_email'] ;

  $stmt = $con->prepare("UPDATE `restaurants` SET `res_lat` = ? , `res_lon` = ? WHERE `res_email` = ?") ;

  $stmt->execute(array($lat , $long , $resemail));

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
