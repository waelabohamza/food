<?php
include "../connect.php" ;
$texiid    = $_POST['texiid'];
$texitoken = $_POST['texitoken'] ;
deleteTokentexi($texiid , $texitoken);
?>
