<?php 

include "../connect.php" ; 


$resid = $_POST['resid'] ; 

 
$datebetween = $_POST['datebetween'] ?? 0;
if (isset($_POST['datebetween'])  &&  $datebetween == "day") {
    $periodget = " خلال اليوم  ";
    $oneday = strtotime("now", time() -  (3600 * 24));
    $startdate = date("Y-m-d", $oneday);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(orders.orders_date) BETWEEN DATE('$startdate') AND DATE('$enddate')   ";
} elseif (isset($_POST['datebetween'])  &&  $datebetween == "week") {
    $periodget = " خلال الشهر  ";
    $onemonth = strtotime("now", time() - ((3600 * 24) * 7));
    $startdate = date("Y-m-d", $onemonth);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(orders.orders_date) BETWEEN DATE('$startdate') AND DATE('$enddate')   ";
}  elseif (isset($_POST['datebetween'])  &&  $datebetween == "month") {
    $periodget = " خلال الشهر  ";
    $onemonth = strtotime("now", time() - ((3600 * 24) * 30));
    $startdate = date("Y-m-d", $onemonth);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(orders.orders_date) BETWEEN DATE('$startdate') AND DATE('$enddate')    ";
}  elseif (isset($_POST['datebetween'])  &&  $datebetween == "threemonth") {
    $periodget = " خلال الشهر  ";
    $onemonth = strtotime("now", time() - ((3600 * 24) * 90));
    $startdate = date("Y-m-d", $onemonth);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(orders.orders_date) BETWEEN DATE('$startdate') AND DATE('$enddate')    ";
} elseif (isset($_POST['datebetween'])  &&  $datebetween == "year") {
    $periodget = " خلال السنة  ";
    $oneyear = strtotime("now", time() -  ((3600 * 24) * 365));
    $startdate  = date("Y-m-d", $oneyear);
    $enddate = date("Y-m-d");

    $and = "AND  DATE(orders.orders_date) BETWEEN DATE('$startdate') AND DATE('$enddate')   ";
} else {
    // if (isset($_POST["checkin"]) && isset($_POST["checkout"])) {
    //     $dateone    = strtotime($_GET["checkin"]);
    //     $datetwo    = strtotime($_GET["checkout"]);
    //     $startdate  = date("Y-m-d", $dateone);
    //     $enddate    = date("Y-m-d", $datetwo);
    //     $and = "AND  DATE(orders_date) BETWEEN DATE('$startdate') AND DATE('$enddate')  ORDER BY bill_id DESC  ";
    // }
    $and = null ; 
}
 

if (isset($_POST['grossing'])){
    $orders = "ORDER BY  totalprice DESC"; 
}else {
    $orders = "ORDER BY count_items DESC" ; 
}
$stmt = $con->prepare("SELECT DISTINCT(details_item)
, SUM(details_quantity) as count_items  
, COUNT(details_item) as countwithoutquantity
, items.item_name 
, items.item_price * SUM(details_quantity) as totalprice
, items.item_res  
, orders.orders_date 
FROM orders_details  
INNER JOIN items ON items.item_id = orders_details.details_item
INNER JOIN orders ON orders.orders_id = orders_details.details_order
WHERE orders.orders_res = ?   $and 
GROUP BY details_item 
$orders
LIMIT 5 
") ; 
$stmt->execute(array($resid)) ; 
$report = $stmt->fetchAll(PDO::FETCH_ASSOC); 
$count = $stmt->rowCount() ; 
if ($count > 0) {
    echo json_encode($report) ; 
}else {
    echo json_encode(array("0" => "faild")) ; 
}

/*
CREATE VIEW report AS 
SELECT DISTINCT(details_item)
, SUM(details_quantity) as count_items  
, COUNT(details_item) as countwithoutquantity
, items.item_name 
, items.item_price * SUM(details_quantity) as totalprice
, items.item_res 
FROM orders_details  
INNER JOIN items ON items.item_id = orders_details.details_item
GROUP BY details_item
ORDER BY count_items DESC
LIMIT 5 
*/

?>

