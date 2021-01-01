<?php

include "../connect.php" ;

 
$catname = $_POST['catsresname'] ;
$imagename =   rand(1000 , 2000) . $_FILES['file']['name'] ;

$sql = "INSERT INTO `categories`(`catsres_name`, `catsres_image`) VALUES (?  , ?)" ;

$stmt = $con->prepare($sql) ;
$stmt->execute(array($catname , $imagename ));
$count = $stmt->rowCount() ;

if ($count > 0) {
	  move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/catsres/". $imagename );
	  echo json_encode(array("status" => "success add")) ;
}else {
	  echo json_encode(array("status" => "faild add catsres")) ;

}
 
