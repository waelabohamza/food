<?php

   include "../connect.php" ;

   $search = filterSan($_POST['search']) ;

   $stmt = $con->prepare("SELECT * FROM `restaurants` WHERE res_name LIKE '%$search%' LIMIT 10 ");

   $stmt->execute();



     $restaurants = $stmt->fetchall(PDO::FETCH_ASSOC);



 $count = $stmt->rowCount()  ;

  if ($count > 0) {
    echo json_encode($restaurants) ;
  }else {
    echo json_encode(array("0" => "faild")) ;
  }



?>
