<?php
include "../connect.php" ;
if (isset($_POST['cat'])) {

$cat  = $_POST['cat'] ;

if ($cat == "0") {

  sendNotifyEveryTaxi("title" , "body") ;


}elseif ($cat == "1") {

  sendNotifyEveryRes("title" , "body") ;


}else {

  sendNotifyEveryUser("user" , "title" , "wael") ;

}

}

echo json_encode(array("status" => "success")) ;  

?>
