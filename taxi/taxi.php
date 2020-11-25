<?php

  include "../connect.php" ;


   $stmt = $con->prepare("SELECT   * FROM `taxi` LIMIT 2 ");

   $stmt->execute();

   $categories = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount() ;

   if ($count > 0) {
     echo json_encode($categories) ;
   }else {
     echo json_encode(array(0 => "faild")) ;
   }




?>
