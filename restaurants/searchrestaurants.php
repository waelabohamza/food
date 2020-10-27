<?php

   include "../connect.php" ;

   $_search = filterSan($_POST['search']) ;

   $stmt = $con->prepare("SELECT   *   FROM `restaurants` WHERE res_name '%$search%'  ");

   $stmt->execute();

   if ( isset($_POST['resid']) ){

     $restaurants = $stmt->fetch(PDO::FETCH_ASSOC);

   }else {

     $restaurants = $stmt->fetchall(PDO::FETCH_ASSOC);

    }

 $count = $stmt->rowCount()  ;

  if ($count > 0) {
    echo json_encode($restaurants) ;

  }else {
    echo json_encode(array("0" => "faild")) ;

  }



?>
