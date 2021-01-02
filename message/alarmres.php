<?php
include "../connect.php";
$resid    = $_POST['resid'];
$ordersid = $_POST['ordersid'];
$table    = $_POST['table'];

// $infoorederstable = array();
// $infoorederstable['resid'] = $resid;
// $infoorederstable['ordersid'] = $ordersid;
// $infoorederstable['table'] = $table;

$title = "تنبيه";
$body = " الرجاء التوجه للطاولة رقم   " . $table;
sendNotifySpecificRes($resid, $title, $body, "", "");
echo json_encode(array("status" => "success"));
