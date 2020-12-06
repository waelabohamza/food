<?php

include "../connect.php" ;




    $stmt = $con->prepare("SELECT  orderstaxi.* , users.*  , taxi.* FROM orderstaxi

       INNER JOIN users ON users.user_id  =  orderstaxi.orderstaxi_user

       INNER JOIN taxi  ON taxi.taxi_id  =  orderstaxi.orderstaxi_taxi

       ORDER BY orderstaxi.orderstaxi_id  DESC

     ");

    $stmt->execute() ;

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC) ;

    $count = $stmt->rowCount() ;

    if ($count > 0 ) {

     echo json_encode($orders);

    }else {

      echo json_encode(array(0 => "faild")) ;

    }




?>
