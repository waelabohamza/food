<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$catid = $_POST['catsresid'] ;
$imagename = $_POST['imagename'] ;

$stmt = $con->prepare("DELETE FROM catsres WHERE catsres_id = ?") ;
$stmt->execute(array($catid));

$count = $stmt->rowCount() ;

if ($count > 0) {
   unlink("../upload/catsres/" . $imagename) ;
   echo json_encode(array('status' => 'success')) ;

}else {
	   echo json_encode(array('status' => 'faild')) ;
}

}


?>
