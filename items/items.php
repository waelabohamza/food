<?php

   include "../connect.php" ;



   if ( isset($_POST['resid']) AND isset($_POST['catid'])){
     $resid  = $_POST['resid'] ;
     $catid  = $_POST['catid'] ;
     $where = "WHERE item_res = $resid  AND item_cat = $catid  " ;

   }elseif(isset($_POST['resid']) AND !isset($_POST['catid']) ) {
       $resid  = $_POST['resid'] ;
       $where = "WHERE item_res = $resid" ;
   }elseif (isset($_POST['catid'])  AND !isset($_POST['resid']) ) {
     $catid  = $_POST['catid'] ;
     $where = "WHERE item_cat = $catid" ;
   } else {
       $where = null  ;
   }

   $stmt = $con->prepare("
       SELECT items.* , categories.* , restaurants.*
       FROM items
       INNER JOIN categories
       ON items.item_cat = categories.cat_id
       INNER JOIN restaurants
       ON items.item_res = restaurants.res_id
       $where

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
