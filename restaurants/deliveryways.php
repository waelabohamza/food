<?php 
 
include "../connect.php" ; 

$resid = $_POST['resid'] ; 

$stmt = $con->prepare("SELECT deliveryways.* , rdtw.*, restaurants.res_name FROM rdtw 
INNER JOIN  deliveryways ON deliveryways.deliveryways_id = rdtw.rdtw_deliveryways 
INNER JOIN restaurants  ON restaurants.res_id = rdtw.rdtw_res
WHERE rdtw_res = ? AND deliveryways.deliveryways_name != 'delivery' ")  ;

$stmt->execute(array($resid)); 

$deliveryways = $stmt->fetchAll(PDO::FETCH_ASSOC) ; 

$count = $stmt->rowCount() ; 

if ($count > 0 ) {
   
echo json_encode($deliveryways) ; 

}else{

echo json_encode($deliveryways) ; 

}

?>
