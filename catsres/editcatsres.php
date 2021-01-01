<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$catname = $_POST['catsresname'] ;

$catid = $_POST['catsresid'] ;

$itemcheck = getThing("catsres" , "catsres_id" , $catid) ;

$imageold = $itemcheck['catsres_image'] ;

if (isset($_FILES['file'])) {

  	 $imagename =  $_FILES['file']['name'] ;
     $stmt = $con->prepare("UPDATE `catsres`
     	                    SET `catsres_name`= ? ,`catsres_image`= ?
     	                    WHERE `catsres_id` = ?
     	                    ") ;
     $stmt->execute(array($catname , $imagename , $catid)) ;
     $count = $stmt->rowCount() ;
     if ($count > 0 ) {
     	   if (file_exists("../upload/catsres/" . $imageold )){
              unlink("../upload/catsres/" . $imageold) ;
			 }
		   move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/catsres/". $imagename );
		   echo json_encode(array("status" => "Success Edit Image")) ;
     } else {
     	   echo json_encode(array("status" => "Faild Edit Image")) ;
     }
}else {
	  $stmt = $con->prepare("UPDATE `catsres`
     	                    SET `catsres_name`= ?
     	                    WHERE `catsres_id` = ?
     	                    ") ;
     $stmt->execute(array($catname  , $catid)) ;

     $count = $stmt->rowCount() ;

     if ($count > 0 ) {
     	   echo json_encode(array("status" => "Success Edit cat res")) ;
     }else {
     	   echo json_encode(array("status" => "Faild Edit cat res")) ;
     }
}
 }






// if ($count > 0) {
// 	file_put_contents("../upload/categories\\" . $imagename , $image );
// 	echo json_encode(array("status" => "success add")) ;
// }
?>
