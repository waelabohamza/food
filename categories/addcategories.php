<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$catname = $_POST['cat_name'] ;
$type = $_POST['type'] ;

$imagename =   rand(1000 , 2000) . $_FILES['file']['name'] ;

$sql = "INSERT INTO `categories`(`cat_name`, `cat_photo` , `cat_type`) VALUES (?  , ? ,  ?  )" ;

$stmt = $con->prepare($sql) ;
$stmt->execute(array($catname , $imagename  , $type  ));

$count = $stmt->rowCount() ;

if ($count > 0) {
	  move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/categories/". $imagename );
	echo json_encode(array("status" => "success add")) ;
}
}
?>
