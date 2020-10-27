<?php
   include "../connect.php" ;
   $stmt = $con->prepare("SELECT DISTINCT restaurants.res_id ,  restaurants.* FROM restaurants
                          INNER JOIN  orders_details ON orders_details.details_res = restaurants.res_id
                          ORDER BY orders_details.details_res ASC
                          LIMIT 5
                          ");
   $stmt->execute();
   $restaurants = $stmt->fetchall(PDO::FETCH_ASSOC);
   $count = $stmt->rowCount()  ;
    if ($count > 0) {
      echo json_encode($restaurants) ;
    }else {
      echo json_encode(array("0" => "faild")) ;
    }



?>
