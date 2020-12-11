<?php
include "../connect.php" ;

if (isset($_POST['cat'])) {

$cat  = $_POST['cat'] ;
$title = $_POST['title'] ; 
$body = $_POST['body'] ; 

if ($cat == "0") {

  sendNotifyEveryTaxi($title , $body  ) ;


}elseif ($cat == "1") {

  sendNotifyEveryRes($title , $body) ;


}else {

  sendNotifyEveryUser("user" , $title , $body) ;

}

}

echo json_encode(array("status" => "success")) ;  

?>
