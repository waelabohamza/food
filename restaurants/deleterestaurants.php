<?php

// include "../connect.php" ;
// if ($_SERVER['REQUEST_METHOD'] == "POST"){
//  if (isset($_POST['resid'])){
//      	$resid = $_POST['resid'] ;
//       $reslogo = $_POST['reslogo'] ;
//       $reslisence = $_POST['reslisence'] ;
//       $checkrestaurant = checkThing (  "restaurants" , "res_id" , $resid  ) ;
//       if ($checkrestaurant > 0 ) {
//       	 $stmt = $con->prepare("DELETE FROM restaurants WHERE res_id = ? ") ;
//       	 $stmt->execute(array($resid)) ;
//       	 $count = $stmt->rowCount() ;
//       	 if ($count > 0) {

//                      unlink("../upload/reslisence/" . $reslisence) ;
//                      unlink("../upload/reslogo/" . $reslogo) ;

      	 	echo json_encode(array("status" => "success")) ;
//       	 }
//       }
//  }

// }else {
// 	echo json_encode(array('status' =>  ' not post  ' )) ;
// }
?>
