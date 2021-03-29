<?php

include "../connect.php";

$resorders  =  $_POST['resid'];

$ordersid     = $_POST['ordersid'];

$usersorders    = $_POST['userid'];

$price = $_POST['price'];



$stmt = $con->prepare("UPDATE orders SET   orders_status = 10   WHERE orders_id  = ? ");

$stmt->execute(array($ordersid));

$count = $stmt->rowCount();

if ($count > 0) {

   removeMoneyById("restaurants", "res_balance",  $price, "res_id", $resorders);

   addMoneyById("users", "user_balance",  $price, "user_id",  $usersorders);

   echo json_encode(array("status" => "success"));

   sendNotifySpecificUser($usersorders, "هام", "تم رفض الطلبية", "", "");
   
} else {

   echo json_encode(array("status" => "faild"));
}
 
    
     

// End Delivery Type
// 0 بانتظار موافقة المطعم
// 1 تم الموافقة من خلال المطعم على الطلب
// 2 تم الموافقة على الطلب من قبل عامل التوصيل
// 3 تم التوصيل
// في حال كان الطلب نوعه طاولة او استلام لايوجد 2 وانما مباشرة 3
// 10 رفض 
