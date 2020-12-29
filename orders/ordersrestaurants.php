
<?php

include "../connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $resid = $_POST['resid'];


  $typeorder =  $_POST['typeorder'];

  if ($typeorder == "wait") {
    $and = "AND orders_status = 0";
  } elseif ($typeorder == "prepare") {
    $and = "AND   ( orders_status = 1 AND orders_type != 'delivery' )  ";
    // AND   ( orders_status = 1 AND orders_type = 'drivethru' ) 
    //          OR   ( orders_status = 1 AND orders_type = 'table' )
  } elseif ($typeorder == "delivery") {
    $and = "AND ( orders_status = 0 OR  orders_status = 1 ) AND orders_type == 'delivery' ";
  }
  else {
    $and = "AND ( orders_status = 3 ) ";
  }


  $stmt = $con->prepare("SELECT DISTINCT  orders_id , orders.*  , users.* , restaurants.* FROM orders
    INNER JOIN users ON users.user_id = orders.orders_users
    INNER JOIN restaurants ON restaurants.res_id = orders.orders_res
    WHERE orders_res = ? $and   ");
  $stmt->execute(array($resid));

  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $count = $stmt->rowCount();

  if ($count > 0) {

    echo json_encode($orders);
  } else {

    echo json_encode(array(0 => "faild"));
  }
}


?>
