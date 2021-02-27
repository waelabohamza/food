<?php

$stmt = $con->prepare("SELECT * FROM `imageshome` WHERE imageshome_id =  ?  ");
$stmt->execute(array("1"));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();



if ($count > 0) {

    $imagetaxi = $_POST['imagetaxi'] ?? $row['imagehome_taxi'];
    $imagefood = $_POST['imagefood'] ?? $row['imagehome_food'];
    $imagepay  = $_POST['imagepay']  ?? $row['imagehome_talabpay'];
    
    


} else {
}
