<?php

    include "connect.php" ;
    $password = $_POST['password']  ;
    $email = filterSan($_POST['email'] , "email") ;
    $stmt = $con->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute(array($password , $email));
    $count = $stmt->rowCount() ;
    if ($count > 0 ) {
      echo json_encode(array("status" => "success")) ;
    }else {
      echo json_encode(array("status" => "faild")) ;
    }


 ?>
