<?php 

include "../connect.php" ; 

if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
 if (isset($_POST['resid'])){

 	$resid = $_POST['resid'] ; 

      $checkrestaurant = checkThing (  "restaurants" , "res_id" , $resid  ) ; 

      if ($checkrestaurant > 0 ) {

      	 $stmt = $con->prepare("UPDATE restaurants SET res_approve  = 1 WHERE res_id = ? ") ; 
      	 $stmt->execute(array($resid)) ; 
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