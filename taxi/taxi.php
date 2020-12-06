<?php

  include "../connect.php" ;


   if (isset($_POST['approve'])) {
        $status = $_POST['approve']  ;
        $where  =  "WHERE taxi_approve = $status" ;
   }else{
         $where = "WHERE taxi_approve = 1" ;
   }

   $stmt = $con->prepare("SELECT   taxi.* , categories.cat_name FROM `taxi`
     INNER JOIN categories ON categories.cat_id = taxi.taxi_cat
     $where  LIMIT 2");

   $stmt->execute();

   $taxi = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount() ;

   if ($count > 0) {
     echo json_encode($taxi) ;
   }else {
     echo json_encode(array(0 => "faild")) ;
   }

?>
