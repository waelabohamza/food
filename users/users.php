<?php

  include "../connect.php" ;


  if ( isset($_POST['userid']) ) {
     $userid = $_POST['userid'] ;
     $where  = "WHERE  `user_id` =  $userid  AND role != 1 " ;
  }else {
    $where  = " WHERE role != 1 " ;
  }

   $stmt = $con->prepare("SELECT   * FROM `users`  $where        ");

   $stmt->execute();

   $users = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount()  ;

   if ($count > 0 ) {
     echo json_encode($users) ;

   }else {
    echo json_encode(array(0 => "faild")) ;
   }



?>
