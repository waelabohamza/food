<?php

   include "../connect.php" ;

     if (isset($_POST['resapprove'])){
     	$value = $_POST['resapprove'] ;
     	$where = "WHERE res_approve = '$value' " ;
    }elseif (isset($_POST['resid'])){
      $value = $_POST['resid'] ;
     	$where = "WHERE res_id  = '$value' " ;
    }
     else {
     	$where = "WHERE res_approve  = 1"  ;
     }

   $stmt = $con->prepare("SELECT   *   FROM `restaurants` $where ");

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
