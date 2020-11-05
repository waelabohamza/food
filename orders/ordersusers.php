<?php

include "../connect.php" ;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $userid = $_POST['userid'] ;

    if (isset($_POST['status'])) {

      $and = "AND orders_status = 3" ;
    }else {
      $and = "AND orders_status != 3" ;

    }

    $stmt = $con->prepare("SELECT  orders.* , users.*  , restaurants.* FROM orders

       INNER JOIN users ON users.user_id  =  orders.orders_users
       INNER JOIN restaurants ON restaurants.res_id  =  orders.orders_res

    WHERE users.user_id = ? $and 

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
