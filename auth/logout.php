<?php
include "../connect.php" ;
$userid    = $_POST['userid'];
$usertoken = $_POST['usertoken'] ;
deleteTokenUser($userid , $usertoken);
echo json_encode(array("status" => "success"));
?>
