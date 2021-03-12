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
    $imagerecivemoneyqrcodeold   =  $row['imageshome_rq'];
    $imagesendmoneyphoneold      =  $row['imageshome_sp'];
    $imagestateaccountold        =  $row['imageshome_sa'];
    $imagemoneychargeold         =  $row['imageshome_charge'];
    // File Request
    $imagetaxi   = $_FILES['taxi']['name']   ?? $imagetaxiold;
    $imagefood   = $_FILES['food']['name']   ?? $imagefoodold;
    $imagepay    = $_FILES['pay']['name']    ?? $imagepayold;
    $imagesq     = $_FILES['sq']['name']     ?? $imagesendmonyqrcodeold;
    $imagerq     = $_FILES['rq']['name']     ?? $imagerecivemoneyqrcodeold;
    $imagesp     = $_FILES['sp']['name']     ?? $imagesendmoneyphoneold;
    $imagesa     = $_FILES['sa']['name']     ?? $imagestateaccountold;
    $imagecharge = $_FILES['charge']['name'] ?? $imagemoneychargeold;
    $data = array(
        "imagehome_taxi"     =>  $imagetaxi,
        "imagehome_food"     =>  $imagefood,
        "imagehome_talabpay" =>  $imagepay,
        "imageshome_sq"      =>  $imagesq,
        "imageshome_rq"      =>  $imagerq,
        "imageshome_sp"      =>  $imagesp,
        "imageshome_sa"      =>  $imagesa,
        "imageshome_charge"  =>  $imagecharge,
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

        if (isset($_FILES['sq']['name'])) {
            $file = $_FILES["sq"];
            $filename =    $file['name'];
            unlink("../upload/home/" . $imagesendmonyqrcodeold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['rq']['name'])) {
            $file = $_FILES["rq"];
            $filename =    $file['name'];
            unlink("../upload/home/" . $imagerecivemoneyqrcodeold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['sp']['name'])) {
            $file = $_FILES["sp"];
            $filename =    $file['name'];
            unlink("../upload/home/" . $imagesendmoneyphoneold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['sa']['name'])) {
            $file = $_FILES["sa"];
            $filename =    $file['name'];
            unlink("../upload/home/" . $imagestateaccountold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['charge']['name'])) {
            $file = $_FILES["charge"];
            $filename =    $file['name'];
            unlink("../upload/home/" . $imagemoneychargeold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "faild"));
    }
} else {
    echo json_encode(array("status" => "faild"));
}
