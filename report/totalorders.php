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

$stmt = $con->prepare("SELECT COUNT(orders.orders_id)   FROM orders WHERE orders.orders_res = ? $and ") ;

$stmt->execute(array($resid)) ;  
 
$countorders = $stmt->fetchColumn() ; 

echo json_encode(array("count" => $countorders)) ; 

?>