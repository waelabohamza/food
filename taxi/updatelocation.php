<?php
include "../connect.php" ;

$taxiid     = $_POST['taxiid'] ;
$taxilat    = $_POST['lat'] ;
$taxilong   = $_POST['long'] ;
// $taxiid     = "7";
// $taxilat    = "23" ;
// $taxilong   =  "23" ;

$stmt = $con->prepare("UPDATE taxi SET taxi_lat  = ? , taxi_long = ? WHERE taxi_id = ? ") ;
$stmt->execute(array($taxilat , $taxilong , $taxiid )) ;

$count = $stmt->rowCount() ;

if ($count > 0) {
         echo json_encode(array("status" => "success")) ;
}else {
         echo json_encode(array("status" => "faild Update Location")) ;
}

?>
