<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$catname = $_POST['cat_name'] ;

$catid = $_POST['cat_id'] ;

$itemcheck = getThing("categories" , "cat_id" , $catid) ;

$imageold = $itemcheck['cat_photo'] ;

if (isset($_FILES['file'])) {

  	 $imagename =  $_FILES['file']['name'] ;



     $stmt = $con->prepare("UPDATE `categories`
     	                    SET `cat_name`= ? ,`cat_photo`= ?
     	                    WHERE `cat_id` = ?
     	                    ") ;
     $stmt->execute(array($catname , $imagename , $catid)) ;
     $count = $stmt->rowCount() ;
     if ($count > 0 ) {
     	   if (file_exists("../upload/categories/" . $imageold )){
              unlink("../upload/categories/" . $imageold) ;
			 }
		   move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/categories/". $imagename );
		   echo json_encode(array("status" => "Success Edit Image")) ;
     } else {
     	   echo json_encode(array("status" => "Faild Edit Image")) ;
     }
}else {
	  $stmt = $con->prepare("UPDATE `categories`
     	                    SET `cat_name`= ?
     	                    WHERE `cat_id` = ?
     	                    ") ;
     $stmt->execute(array($catname  , $catid)) ;

     $count = $stmt->rowCount() ;

     if ($count > 0 ) {
     	   echo json_encode(array("status" => "Success Edit Category")) ;
     }else {
     	   echo json_encode(array("status" => "Faild Edit Category")) ;
     }
}
 }






// if ($count > 0) {
// 	file_put_contents("../upload/categories\\" . $imagename , $image );
// 	echo json_encode(array("status" => "success add")) ;
// }
?>
