<?php

include "../connect.php" ;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $userid = $_POST['userid'] ;

    $stmt = $con->prepare("SELECT  orders.* , users.*  FROM orders

    INNER JOIN users ON users.user_id  =  orders.orders_users

    WHERE users.user_id = ?

    ORDER BY orders.orders_id  DESC

     ") ;
    $stmt->execute(array( $userid )) ;

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC) ;

    $count = $stmt->rowCount() ;

    if ($count > 0 ) {

     echo json_encode($orders);

    }else {

      echo json_encode(array(0 => "faild")) ;


    }


  }


?>
