<?php

include "../connect.php" ;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $userid = $_POST['userid'] ;

    if (isset($_POST['status'])) {

      $status = $_POST['status'] ;

      $and = "AND orderstaxi_status = $status" ;

    }else {

      $and = "AND orderstaxi_status = 0 || orderstaxi_status = 1 " ;

    }

    $stmt = $con->prepare("SELECT  orderstaxi.* , users.*  , taxi.* FROM orderstaxi

       INNER JOIN users ON users.user_id  =  orderstaxi.orderstaxi_user

       INNER JOIN taxi  ON taxi.taxi_id  =  orderstaxi.orderstaxi_taxi

       WHERE users.user_id = ? $and

       ORDER BY orderstaxi.orderstaxi_id  DESC

     ");

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
