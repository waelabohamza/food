<?php
include "../connect.php" ;
$resid    = $_POST['resid'];
$restoken = $_POST['restoken'] ;
deleteTokenRes($resid , $restoken);
echo json_encode(array("status" => "success"));
?>
