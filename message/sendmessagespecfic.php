<?php
include "../connect.php" ;
if (isset($_POST['cat'])) {

$cat  = $_POST['cat'] ;
$title = $_POST['title'] ; 
$body = $_POST['body'] ; 

if ($cat == "0"){
    $taxiid = $_POST['taxiid'] ; 
    sendNotifySpecificTaxi($taxiid , $title , $body , "" , "welcome") ; 
}elseif ($cat == "1") {
    $resid = $_POST['resid'] ; 
    sendNotifySpecificRes($resid , $title , $body , "" , "welcome") ; 
}else {
    $userid = $_POST['userid'] ; 
    sendNotifySpecificUser($userid , $title , $body , "" , "welcome") ; 
}
}

echo json_encode(array("status" => "success")) ;  

?>
