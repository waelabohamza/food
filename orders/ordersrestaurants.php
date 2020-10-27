
<?php

include "../connect.php" ;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $resid = $_POST['resid'] ;

    $stmt = $con->prepare("SELECT DISTINCT  orders_id , orders.*  , users.* FROM orders
    INNER JOIN users ON users.user_id = orders.orders_users
    INNER JOIN orders_details ON orders_details.details_order = orders.orders_id
    WHERE orders_details.details_res = ?
     ") ;
    $stmt->execute(array( $resid )) ;

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC) ;

    $count = $stmt->rowCount() ;

    if ($count > 0 ) {

     echo json_encode($orders);

    }else {

      echo json_encode(array(0 => "faild")) ;


    }


  }


?>
