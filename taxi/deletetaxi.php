<?php

include "../connect.php" ;
if ($_SERVER['REQUEST_METHOD'] == "POST"){
 if (isset($_POST['id'])){

     	$taxiid   = $_POST['id'] ;
      $image    = $_POST['image'] ;
      $licence  = $_POST['licence'] ;

      $checktaxi = checkThing (  "taxi" , "taxi_id" , $taxiid  ) ;
      if ($checktaxi > 0 ) {
      	 $stmt = $con->prepare("DELETE FROM taxi WHERE taxi_id = ? ") ;
      	 $stmt->execute(array($taxiid)) ;
      	 $count = $stmt->rowCount() ;
      	 if ($count > 0) {

                     unlink("../upload/taxilicence/" . $licence) ;
                     unlink("../upload/taxiimage/" . $image) ;

      	 	echo json_encode(array("status" => "success")) ;
      	 }
      }
 }

}else {
	echo json_encode(array('status' =>  ' not post  ' )) ;
}
?>
