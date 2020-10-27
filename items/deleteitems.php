<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$itemid = $_POST['itemid'] ;
$imagename = $_POST['imagename'] ;

$stmt = $con->prepare("DELETE FROM items WHERE item_id = ?") ;
$stmt->execute(array($itemid));

$count = $stmt->rowCount() ;

if ($count > 0) {
   unlink("../upload/items/" . $imagename) ; 
   echo json_encode(array('status' => 'success')) ;

}else {
	   echo json_encode(array('status' => 'faild')) ;
}

 }

?>
