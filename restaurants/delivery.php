<?php

  include "../connect.php" ;

   $deliveryres = $_POST['deliveryres'] ;

   $stmt = $con->prepare("SELECT   * FROM `users`  WHERE delivery_res = ?   AND role = 3 ");

   $stmt->execute( array( $deliveryres ) );

   $deliveries = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount()  ;

   if ($count > 0 ) {
     echo json_encode($deliveries) ;

   }else {
    echo json_encode(array(0 => "faild")) ;
   }



?>
