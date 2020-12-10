<?php 

  include "../connect.php" ; 

  $email = $_POST['resemail'] ; 

  $timedelivery   =   filterSan($_POST['timedelivery'], "number");
  $pricedelivery  =   $_POST['pricedelivery'];
  $description    =   filterSan($_POST['description']);
  $type           =   filterSan($_POST['type']);

$stmt = $con->prepare("UPDATE `restaurants` 
                       SET    `res_type` = ? , `res_description` = ? , `res_time_delivery` = ?  , `res_price_delivery` = ?    
                       WHERE  `res_email` = ?") ;
$stmt->execute(array($type , $description , $timedelivery ,  $pricedelivery , $email)) ; 

echo json_encode(array("status" => "success")) ; 


?>