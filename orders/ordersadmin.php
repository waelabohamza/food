<?php

include "../connect.php" ;





    $stmt = $con->prepare("SELECT  orders.* , users.*  , restaurants.* FROM orders

       INNER JOIN users ON users.user_id  =  orders.orders_users
       INNER JOIN restaurants ON restaurants.res_id  =  orders.orders_res

         ORDER BY orders.orders_id  DESC

     ") ;
    $stmt->execute(array()) ;

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC) ;

    $count = $stmt->rowCount() ;

    if ($count > 0 ) {

     echo json_encode($orders);

    }else {

      echo json_encode(array(0 => "faild")) ;

    }




?>
