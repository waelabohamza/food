<?php
 include "connect.php" ;
 $resid = $_POST['resid'] ;
 $sql = " SELECT
    (SELECT COUNT(item_id)    FROM items
    INNER JOIN restaurants ON restaurants.res_id = items.item_res
    WHERE item_res = $resid) as items    ,
    (SELECT DISTINCT  COUNT(orders_id)   FROM orders
    INNER JOIN orders_details ON orders_details.details_order = orders.orders_id
    WHERE orders_details.details_res  =  $resid ) as orders ,
    (SELECT restaurants.res_balance FROM restaurants WHERE restaurants.res_id = $resid) as balance
    "  ;
 $stmt = $con->prepare($sql) ;
 $stmt->execute() ;
 $countall  = $stmt->fetch(PDO::FETCH_ASSOC)  ;
 echo json_encode($countall) ;
?>
