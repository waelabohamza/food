<?php

include "../connect.php";
$data = json_decode(file_get_contents('php://input'), true);


$deliveryways = $data['deliveryways'];
$email        = $data['email'];

// $deliveryways = [1, 2, 3];
// $email = "kfc@gmail.com";

$stmt  = $con->prepare("SELECT res_id FROM restaurants WHERE res_email = ?");
$stmt->execute(array($email));
$resid = $stmt->fetchColumn();
$count = $stmt->rowCount();

foreach ($deliveryways as $val) {
    $stmt2 = $con->prepare("INSERT INTO `rdtw`(`rdtw_res`, `rdtw_deliveryways`) VALUES ($resid , $val)");
    $stmt2->execute();
}

$count = $stmt2->rowCount();

if ($count  > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "faild"));
}
