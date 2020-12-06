<?php

  include "../connect.php" ;

   $search = filterSan($_POST['search']) ;

   $stmt = $con->prepare("SELECT taxi.* , categories.cat_name  FROM taxi
                        INNER JOIN categories ON categories.cat_id = taxi.taxi_cat
                        WHERE  taxi.taxi_username
                        LIKE '%$search%' OR
                        taxi.taxi_model
                        LIKE '%$search%' OR
                        categories.cat_name LIKE '%$search%' 
                        LIMIT   5 ");

   $stmt->execute();

   $taxi = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount() ;

   if ($count > 0) {

     echo json_encode($taxi) ;

   }else {

     echo json_encode(array(0 =>"faild"));

   }

?>
