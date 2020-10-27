<?php 
 
 include "../connect.php" ; 

 $id = $_POST['id'] ; 

 $username  = $_POST['username']  ; 

 $password  = $_POST['password'] ; 

 $email = $_POST['email'] ; 

 $sql = "UPDATE users SET username = ? , password = ? , email = ?  WHERE user_id = ? ";

 $stmt = $con->prepare($sql) ; 

 $stmt->execute(array($username , $password , $email , $id)) ; 

 $count = $stmt->rowCount() ; 

 if ($count > 0) {

 	echo json_encode(array("status" => "update success")) ; 

 }else {

 	echo json_encode(array("status" => "there is not update")) ; 

 }



?>