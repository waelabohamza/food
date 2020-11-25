<?php

include "../connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $taxiemail    = $_POST['email']       ;
  $id  = getIdByThing("user_id" , "users" , "email" , $taxiemail);   //get User Taxi
  $model        = $_POST['model']       ;
  $year         = $_POST['year']        ;
  $brand        = $_POST['brand']       ;
  $description  = $_POST['description'] ;
  $price        = $_POST['price']       ;
  // Start Images
  $imagenamecar =   rand(1000 , 2000) .   $_FILES['file']['name'] ;
  $imagenamelicence =   rand(1000 , 2000) .  $_FILES['filetwo']['name'] ;
    $stmt   = $con->prepare("INSERT INTO `taxi`( `taxi_user`, `taxi_model`, `taxi_year`, `taxi_licence`, `taxi_brand`, `taxi_description` , `taxi_image`, `taxi_approve`, `taxi_price`)
                             VALUES ( :us , :mo , :ye , :li , :br , :des , :img , 0 , :pr )") ;
    $stmt->execute(array(
      ':us'   =>  $id ,
      ':mo'   =>  $model ,
      ':ye'   =>  $year ,
      ':li'   =>  $imagenamelicence ,
      ':br'   =>  $brand ,
      ':des'  =>  $description ,
      ':img'  =>  $imagenamecar ,
      ':pr'   =>  $price
    )) ;
    $row = $stmt->rowcount() ;
    if ($row > 0) {
      // echo "success" ;
	      move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/taxiimage/". $imagenamecar );
    	  move_uploaded_file($_FILES["filetwo"]["tmp_name"], "../upload/taxilicence/". $imagenamelicence );
        echo json_encode(array("status" => "success"));
    }
  // End Check
}
?>
