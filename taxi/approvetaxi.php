<?php

include "../connect.php" ;
if ($_SERVER['REQUEST_METHOD'] == "POST"){
 if (isset($_POST['id'])){

     	$taxiid   = $_POST['id'] ;
      $price  = $_POST['price'] ;
      $initialprice  = $_POST['initialprice'] ;


      $checktaxi = checkThing (  "taxi" , "taxi_id" , $taxiid  ) ;
      if ($checktaxi > 0 ) {
      	 $stmt = $con->prepare("UPDATE  taxi SET  taxi_price = ? , taxi_mincharge = ?   ,  taxi_approve = 1     WHERE  taxi_id = ? ") ;
      	 $stmt->execute(array( $price , $initialprice , $taxiid)) ;
      	 $count = $stmt->rowCount() ;
      	 if ($count > 0) {
      	 	echo json_encode(array("status" => "success")) ;
      	 }
      }
 }

}else {
	echo json_encode(array('status' =>  ' not post  ' )) ;
}
?>
