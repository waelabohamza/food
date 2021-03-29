<?php 
//  header('Access-Control-Allow-Origin: *');
 include "connect.php" ; 

 $sql = " SELECT 
    (select COUNT(*)  from categories  ) as cats ,
    (select COUNT(*) from restaurants ) as res   ,  
    (select COUNT(*) from users ) as users   , 
    (select COUNT(*) from items ) as items"   ;

 $stmt = $con->prepare($sql) ;
 $stmt->execute() ; 
 $countall  = $stmt->fetch(PDO::FETCH_ASSOC)  ; 

 echo json_encode($countall) ;
?>