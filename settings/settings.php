<?php

 include "../connect.php" ;

 $id = $_POST['id'] ;

 $sql = "SELECT * FROM users WHERE role = 1 AND user_id = ?" ;

 $stmt = $con->prepare($sql) ;

 $stmt->execute(array($id)) ;

 $admin = $stmt->fetch(PDO::FETCH_ASSOC) ;

 $count = $stmt->rowCount() ;

 if ( $count > 0 ) {

   echo json_encode($admin) ;

 } else {
   echo json_encode(array("status" => "faild")) ;

 }

?>
