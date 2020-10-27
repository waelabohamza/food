<?php 

  include "../connect.php";
  $itemres = $_POST['resid'] ; 
  
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
  
  $stmt = $con->prepare("SELECT COUNT(`item_id`) FROM items  WHERE item_res = ? ") ; 
  $stmt->execute(array($itemres))  ; 

  $number =  $stmt->fetch() ; 
  
  $count = $stmt->rowCount() ; 

  if ($count > 0 ) {
  	echo json_encode( array('status' => 'success' , 'count' => $number[0]));
  }else {
	echo json_encode(array("status" => "faild ")) ; 

}

}


?>