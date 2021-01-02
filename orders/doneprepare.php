<?php

include "../connect.php";
$orderid = $_POST['orderid'];
$orderuser = $_POST['userorder'];
$typeprepare = $_POST['typeprepare'] ?? "";

if ($typeprepare == "tableqrcode") {
  $typeprepare = 2;
} else {
  $typeprepare = 3;
}



$stmt = $con->prepare(" UPDATE orders SET orders_status = ? WHERE orders_id = ? ");
$stmt->execute(array($typeprepare, $orderid));
$count = $stmt->rowCount();
if ($count > 0) {
  echo json_encode(array("status" => "success"));
  $title =  "تنبيه";
  $body =  "تم التحضير بنجاح";
  sendNotifySpecificUser($orderuser, $title, $body, "", "");
} else {
  echo json_encode(array("status" => "faild"));
}
