<?php
   include "../connect.php" ;
   $stmt = $con->prepare("SELECT   restaurants.* , orders.* FROM restaurants
                          INNER JOIN   orders ON orders.orders_res = restaurants.res_id
                          ORDER BY orders.orders_res DESC
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
