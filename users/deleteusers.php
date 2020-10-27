<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$userid = $_POST['userid'] ;
$imagename = $_POST['userimage'] ;

$stmt = $con->prepare("DELETE FROM `users` WHERE `user_id` = ?") ;
$stmt->execute(array($userid));

$count = $stmt->rowCount() ;

if ($count > 0) {
   unlink("../upload/users/" . $imagename) ;
   echo json_encode(array('status' => 'success')) ;

}else {
	   echo json_encode(array('status' => 'faild')) ;
}

}


?>
