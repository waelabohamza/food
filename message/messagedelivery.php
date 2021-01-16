<?php 
include "../connect.php" ; 
$deliveryid = $_POST['deliveryid']; 
$stmt = $con->prepare("SELECT * FROM `message` 
                       WHERE  (message_cat = 2 AND message_sid = 0 ) 
                       OR     (message_cat = 2 AND message_sid = ?)
                       ORDER BY message_id DESC
                       ") ;
$stmt->execute(array($deliveryid)) ;
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC) ; 
$count = $stmt->rowCount() ; 
if ( $count  > 0 ){
    echo json_encode($messages) ;   
}else {
    echo json_encode(array(0 => "faild")); 
}
?>