<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$title  = $_POST['offers_title'] ;
$body   = $_POST['offer_body'] ;

$imagename =   rand(1000 , 2000) . $_FILES['file']['name'] ;

$sql = "INSERT INTO `offers`(`offers_title`, `offers_image` , `offers_body`) VALUES (?  , ? ,  ?  )" ;

$stmt = $con->prepare($sql) ;
$stmt->execute(array($title , $imagename  , $body  ));

$count = $stmt->rowCount() ;

if ($count > 0) {
	  move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/offers/". $imagename );
	  echo json_encode(array("status" => "success add")) ;
}
}
?>
