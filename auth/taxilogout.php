<?php
include "../connect.php" ;
$texiid    = $_POST['texiid'];
$texitoken = $_POST['texitoken'] ;
deleteTokenTaxi($texiid , $texitoken);
echo json_encode(array("status" => "success"));
?>
