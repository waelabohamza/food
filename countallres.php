<?php
 include "connect.php" ;
 $resid = $_POST['resid'] ;
 $sql = " SELECT
    (SELECT COUNT(item_id)    FROM items
    INNER JOIN restaurants ON restaurants.res_id = items.item_res
    WHERE item_res = $resid) as items    ,
    (SELECT DISTINCT  COUNT(orders_id)    FROM orders
       where  orders.orders_res =   $resid AND orders_status = 0   ) as orders ,
       (SELECT    COUNT(users.user_id)     FROM users
    WHERE  users.delivery_res = $resid) as delivery  ,
    (SELECT restaurants.res_balance FROM restaurants WHERE restaurants.res_id = $resid ) as balance
    "  ;
 $stmt = $con->prepare($sql) ;
 $stmt->execute() ;
 $countall  = $stmt->fetch(PDO::FETCH_ASSOC)  ;
 echo json_encode($countall) ;
?>
