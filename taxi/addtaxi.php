<?php

include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $taxiemail    = $_POST['email']       ;
  $id  = getIdByThing("taxi_id" , "taxi" , "taxi_email" , $taxiemail);   //get User Taxi
  $model        = $_POST['model']       ;
  $year         = $_POST['year']        ;
  $description  = $_POST['description'] ;
  $taxibrand    = $_POST['brand']       ;

  $stmt2 = $con->prepare("SELECT * FROM categories WHERE cat_name = ? ") ;
  $stmt2->execute(array($taxibrand)) ;
  $cats = $stmt2->fetch() ;

  $count = $stmt2->rowCount() ;
  if ($count > 0) {

      $taxibrand  =  $cats['cat_id'] ;

      // Start Images
      $imagenamecar =   rand(1000 , 2000) .   $_FILES['file']['name'] ;
      $imagenamelicence =   rand(1000 , 2000) .  $_FILES['filetwo']['name'] ;

        $stmt   = $con->prepare("UPDATE `taxi` SET
          `taxi_model`        =  :mo ,
          `taxi_year`         =  :ye ,
          `taxi_licence`      =  :li ,
          `taxi_description`  =  :des,
          `taxi_image`        =  :img ,
          `taxi_cat`          =  :ca
          WHERE  `taxi_id` = :id   ") ;

        $stmt->execute(array(
          ':id'   =>  $id ,
          ':mo'   =>  $model ,
          ':ye'   =>  $year ,
          ':li'   =>  $imagenamelicence ,
          ':des'  =>  $description ,
          ':img'  =>  $imagenamecar ,
          ':ca'   => $taxibrand

        )) ;
        $row = $stmt->rowcount() ;
        if ($row > 0) {
          // echo "success" ;

        

    	      move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/taxiimage/". $imagenamecar );
        	  move_uploaded_file($_FILES["filetwo"]["tmp_name"], "../upload/taxilicence/". $imagenamelicence );
            echo json_encode(array("status" => "success"));
        }



  }

  // End Check
}
