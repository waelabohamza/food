<?php
include "../connect.php";
$stmt = $con->prepare("SELECT * FROM `imageshome` WHERE imageshome_id =  ?  ");
$stmt->execute(array("1"));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();



if ($count > 0) {

    $imagetaxiold                =  $row['imagehome_taxi'];
    $imagefoodold                =  $row['imagehome_food'];
    $imagepayold                 =  $row['imagehome_talabpay'];
    $imagesendmonyqrcodeold      =  $row['imageshome_sq'];
    $imagerecivemoneyqrocdeold   =  $row['imageshome_rq'];
    $imagepayold                 =  $row['imageshome_sp'];
    $imagepayold                 =  $row['imageshome_sa'];
    $imagepayold                 =  $row['imageshome_charge'];




    $imagetaxi = $_FILES['taxi']['name']  ?? $imagetaxiold;
    $imagefood = $_FILES['food']['name']  ??  $imagefoodold;
    $imagepay  = $_FILES['pay']['name'] ?? $imagepayold;

    $data = array(
        "imagehome_taxi"     =>  $imagetaxi,
        "imagehome_food"     =>  $imagefood,
        "imagehome_talabpay" =>  $imagepay,
    );
    $count = updateData("imageshome", $data, "imageshome_id = 1 ");
    if ($count > 0) {
        if (isset($_FILES['taxi']['name'])) {
            $file = $_FILES["taxi"];
            $filename =    $file['name'];
            unlink("../upload/home/" . $imagetaxiold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" .     $filename);
        }
        if (isset($_FILES['food']['name'])) {
            $file = $_FILES["food"];
            $filename =   $file['name'];
            unlink("../upload/home/" . $imagefoodold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" .     $filename);
        }
        if (isset($_FILES['pay']['name'])) {
            $file = $_FILES["pay"];
            $filename =    $file['name'];
            unlink("../upload/home/" . $imagepayold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "faild"));
    }
} else {
    echo json_encode(array("status" => "faild"));
}
