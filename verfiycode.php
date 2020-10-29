<?php

    include "connect.php" ;
    $code = filterSan($_POST['code'] , "number") ;
    $email = filterSan($_POST['email'] , "email") ;
    $stmt = $con->prepare("SELECT * FROM users WHERE verfiycode = ? AND email = ? ");
    $stmt->execute(array($code , $email));
    $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
    $count = $stmt->rowCount() ;
    if ($count > 0 ){
      echo json_encode(array("status" => "success")) ;
    }else {
      echo json_encode(array("status" => "faild")) ;
    }


 ?>
