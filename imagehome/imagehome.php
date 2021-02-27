<?php 
include "../connect.php" ; 
$stmt = $con->prepare("SELECT * FROM `imageshome`") ; 
$stmt->execute() ; 
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($rows) ; 


?>