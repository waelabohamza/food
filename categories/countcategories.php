<?php 

  include "../connect.php";

  if ($_SERVER['REQUEST_METHOD'] == "POST"){
 
  $stmt = $con->prepare("SELECT COUNT(`cat_id`) FROM categories  ") ; 
  $stmt->execute(array( ))  ; 

  $number =  $stmt->fetch() ; 
  
  $count = $stmt->rowCount() ; 

  if ($count > 0 ) {
  	echo json_encode( array('status' => 'success' , 'count' => $number[0]));
  }

  }

?>