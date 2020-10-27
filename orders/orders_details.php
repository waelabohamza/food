<?php

include "../connect.php" ;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $orderid = $_POST['orderid'] ;
    $stmt = $con->prepare("SELECT orders.* , orders_details.* , items.* , restaurants.*
                          FROM orders_details
      INNER JOIN  orders ON orders.orders_id = orders_details.details_order
      INNER JOIN  items ON items.item_id = orders_details.details_item
      INNER JOIN  restaurants ON restaurants.res_id = orders_details.details_res
      WHERE orders.orders_id = $orderid
     ") ;
    $stmt->execute(array( $orderid )) ;

    $orderdetails = $stmt->fetchAll(PDO::FETCH_ASSOC) ;

    $count = $stmt->rowCount() ;

    if ($count > 0 ) {

     echo json_encode($orderdetails);

    }else {

        echo json_encode(array('status' => 'faild' )) ;

    }


  }


?>
