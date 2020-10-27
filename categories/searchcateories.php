<?php

  include "../connect.php" ;

   $search = filterSan($_POST['search']) ;

   $stmt = $con->prepare("SELECT *  FROM categories WHERE  categories.cat_name  LIKE '%$search%' LIMIT   5 ");

   $stmt->execute();

   $categories = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount() ;

   if ($count > 0) {

     echo json_encode($categories) ;

   }else {
     echo json_encode(array(0 =>"faild"));
   }

?>
