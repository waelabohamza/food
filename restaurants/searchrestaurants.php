<?php

   include "../connect.php" ;

   $search = filterSan($_POST['search']) ;

   $stmt = $con->prepare("SELECT restaurants.* , catsres.catsres_name    FROM `restaurants`
   INNER JOIN catsres ON catsres.catsres_id  = restaurants.res_type
   WHERE  res_approve = 1 AND   res_name  LIKE '%$search%'  LIMIT 10");

   $stmt->execute();



     $restaurants = $stmt->fetchall(PDO::FETCH_ASSOC);



 $count = $stmt->rowCount()  ;

  if ($count > 0) {
    echo json_encode($restaurants) ;
  }else {
    echo json_encode(array("0" => "faild")) ;
  }



?>
