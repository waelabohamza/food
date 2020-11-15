
<?php

include "../connect.php" ;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $resid = $_POST['resid'] ;



    $stmt = $con->prepare("SELECT DISTINCT  orders_id , orders.*  , users.* , restaurants.* FROM orders
    INNER JOIN users ON users.user_id = orders.orders_users
    INNER JOIN restaurants ON restaurants.res_id = orders.orders_res
    WHERE orders_res = ? AND orders_status = 0
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
