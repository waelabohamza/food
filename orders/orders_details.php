<?php
include "../connect.php"   ;
$ordersid = $_POST['ordersid'] ;
$stmt = $con->prepare("SELECT orders_details.* , orders.* , items.* FROM orders_details
INNER JOIN orders ON orders.orders_id = orders_details.details_order
INNER JOIN items ON items.item_id = orders_details.details_item
WHERE orders.orders_id = ?") ;
$stmt->execute(array($ordersid)) ;
$count = $stmt->rowCount() ;
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
if ($count > 0 ) {
echo json_encode($orders) ;
}else {

}

?>
