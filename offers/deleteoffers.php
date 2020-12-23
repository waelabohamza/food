<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$offersid = $_POST['offerid'] ;
$imagename = $_POST['imagename'] ;

$stmt = $con->prepare("DELETE FROM offers WHERE offers_id = ?") ;
$stmt->execute(array($offersid));

$count = $stmt->rowCount() ;

if ($count > 0) {
   unlink("../upload/offers/" . $imagename) ;
   echo json_encode(array('status' => 'success')) ;

}else {
	   echo json_encode(array('status' => 'faild')) ;
}

}


?>
