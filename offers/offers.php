<?php
include "../connect.php";
$stmt =  $con->prepare("SELECT * FROM `offers`");
$stmt->execute();
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($offers);
?>