<?php

   include "../connect.php" ;

   $search = filterSan($_POST['search']) ;

   $stmt = $con->prepare(" SELECT items.* , categories.* , restaurants.*
       FROM items
       INNER JOIN categories
       ON items.item_cat = categories.cat_id
       INNER JOIN restaurants
       ON items.item_res = restaurants.res_id
       WHERE   items.item_name LIKE '%$search%' LIMIT   10
   	");

   $stmt->execute();

   $items = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount() ;
  if ($count > 0 ) {
   echo json_encode($items) ;
  }else {
  echo json_encode(array(0 => "faild")) ;
   }



?>
