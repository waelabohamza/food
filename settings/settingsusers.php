<?php 
 include "../connect.php"; 

 $userid = $_POST['userid'] ; 

 if (isset($_POST['email'])) {

    $email = $_POST['email'] ; 
    $stmt = $con->prepare("SELECT * FROM users WHERE  email = ?  AND  `user_id` != ?  ") ; 
    $stmt->execute(array( $email , $userid )); 
    $count = $stmt->rowCount() ; 
    if ($count > 0) {
          echo json_encode(array("status" => "email already exists")) ; 
    }else {
        $stmt2 = $con->prepare("UPDATE users SET email = ? WHERE `user_id` = ?  ") ; 
        $stmt2->execute(array( $email , $userid )); 
        $count = $stmt2->rowCount() ; 
        echo json_encode(array("status" => "success")) ; 
    }

 }
 if (isset($_POST['phone'])) {

    $phone = $_POST['phone'] ; 
    $stmt = $con->prepare("SELECT * FROM users WHERE  user_phone = ?  AND  `user_id` != ?  ") ; 
    $stmt->execute(array( $phone , $userid )); 
    $count = $stmt->rowCount() ; 
    if ($count > 0) {
          echo json_encode(array("status" => "phone already exists")) ; 
    }else {
        $stmt2 = $con->prepare("UPDATE users SET user_phone = ? WHERE `user_id` = ?  ") ; 
        $stmt2->execute(array( $phone , $userid )); 
        $count = $stmt2->rowCount() ; 
        echo json_encode(array("status" => "success")) ; 
    }
     
}
 if (isset($_POST['password'])) {
    $password = $_POST['password'] ; 
    $stmt = $con->prepare("UPDATE users SET `password` = ? WHERE `user_id` = ?  ") ; 
    $stmt->execute(array( $password , $userid )); 
    $count = $stmt->rowCount() ; 
    echo json_encode(array("status" => "success")) ; 
     
}
if (isset($_POST['username'])) {
    $username = $_POST['username'] ; 
    $stmt = $con->prepare("UPDATE users SET `username` = ? WHERE `user_id` = ?  ") ; 
    $stmt->execute(array( $username , $userid )); 
    $count = $stmt->rowCount() ; 
    echo json_encode(array("status" => "success")) ; 
}

 
