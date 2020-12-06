<?php

include "../connect.php"  ;

$taxiid = $_POST['taxiid'] ;

$stmt = $con->prepare("SELECT taxi_lat  , taxi_long , taxi_username FROM taxi WHERE taxi_id = ?");

$stmt->execute(array($taxiid));

$taxi = $stmt->fetch(PDO::FETCH_ASSOC);

$count = $stmt->rowCount() ;

if ($count > 0 ) {

  echo json_encode(array($taxi)) ;

}else {

  echo json_encode(array("faild")) ;
  
}

?>
