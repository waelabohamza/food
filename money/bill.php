<?php

include "../connect.php";

$userid = 9;

$datebetween = $_POST['datebetween'];

if (isset($_POST['datebetween'])  &&  $datebetween == "day") {
    $periodget = " خلال اليوم  ";
    $oneday = strtotime("now", time() -  (3600 * 24));
    $startdate = date("Y-m-d", $oneday);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(bill_date) BETWEEN DATE('$startdate') AND DATE('$enddate')   ";
} elseif (isset($_POST['datebetween'])  &&  $datebetween == "week") {
    $periodget = " خلال الشهر  ";
    $onemonth = strtotime("now", time() - ((3600 * 24) * 7));
    $startdate = date("Y-m-d", $onemonth);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(bill_date) BETWEEN DATE('$startdate') AND DATE('$enddate')   ";
}  elseif (isset($_POST['datebetween'])  &&  $datebetween == "month") {
    $periodget = " خلال الشهر  ";
    $onemonth = strtotime("now", time() - ((3600 * 24) * 30));
    $startdate = date("Y-m-d", $onemonth);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(bill_date) BETWEEN DATE('$startdate') AND DATE('$enddate')    ";
}  elseif (isset($_POST['datebetween'])  &&  $datebetween == "threemonth") {
    $periodget = " خلال الشهر  ";
    $onemonth = strtotime("now", time() - ((3600 * 24) * 90));
    $startdate = date("Y-m-d", $onemonth);
    $enddate = date("Y-m-d");
    $and = "AND  DATE(bill_date) BETWEEN DATE('$startdate') AND DATE('$enddate')    ";
} elseif (isset($_POST['datebetween'])  &&  $datebetween == "year") {
    $periodget = " خلال السنة  ";
    $oneyear = strtotime("now", time() -  ((3600 * 24) * 365));
    $startdate  = date("Y-m-d", $oneyear);
    $enddate = date("Y-m-d");

    $and = "AND  DATE(bill_date) BETWEEN DATE('$startdate') AND DATE('$enddate')   ";
} else {
    // if (isset($_POST["checkin"]) && isset($_POST["checkout"])) {
    //     $dateone    = strtotime($_GET["checkin"]);
    //     $datetwo    = strtotime($_GET["checkout"]);
    //     $startdate  = date("Y-m-d", $dateone);
    //     $enddate    = date("Y-m-d", $datetwo);
    //     $and = "AND  DATE(bill_date) BETWEEN DATE('$startdate') AND DATE('$enddate')  ORDER BY bill_id DESC  ";
    // }
    $and = null ; 
}


$stmt = $con->prepare("SELECT * FROM `bill` WHERE bill_user  =  ? And  bill_cat = 0 $and  ORDER BY bill_id DESC ");

$stmt->execute(array($userid));

$bill = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode($bill);
} else {
    echo json_encode(array("status" => "faild"));
}
