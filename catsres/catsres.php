<?php
include "../connect.php" ;

   $stmt = $con->prepare("SELECT   * FROM `catsres`   ");

   $stmt->execute();

   $categories = $stmt->fetchall(PDO::FETCH_ASSOC);

   echo json_encode($categories) ;
