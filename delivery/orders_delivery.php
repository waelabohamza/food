
<?php

include "../connect.php" ;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $resid = $_POST['resid'] ;
    $userid = $_POST['userid'] ;
    $status = $_POST['status'] ;
    $and = "AND orders_delivery = $userid AND  orders_status = $status   " ;
    if ( $_POST['status'] == 0 ) {
      $and = " AND  orders_status = $status AND orders_delivery = 0  " ; 
    }

    $stmt = $con->prepare("SELECT DISTINCT  orders_id , orders.*  , users.* FROM orders
    INNER JOIN users ON users.user_id = orders.orders_users
    WHERE orders_res = ?  $and

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
