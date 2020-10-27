<?php 
  
  include "../connect.php" ; 
  
    $stmt = $con->prepare("SELECT   count(res_id)  as count FROM `restaurants`  ");
   
   $stmt->execute(); 

   $countres = $stmt->fetch(PDO::FETCH_ASSOC);
  
   echo json_encode($countres) ; 

 

?>	