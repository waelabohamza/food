<?php

   include "../connect.php" ;

   $userid = $_POST['userid'] ; 

   $stmt = $con->prepare("SELECT   * FROM `users` WHERE `user_id` = ? LIMIT 1");

   $stmt->execute(array($userid));

   $categories = $stmt->fetch(PDO::FETCH_ASSOC);

   echo json_encode($categories) ;
