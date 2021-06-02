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

    $rand1 = rand(100000, 9999999);
    $rand2 = rand(100000, 9999999);
    $rand3 = rand(100000, 9999999);
    $rand4 = rand(100000, 9999999);
    $rand5 = rand(100000, 9999999);
    $rand6 = rand(100000, 9999999);
    $rand7 = rand(100000, 9999999);
    $rand8 = rand(100000, 9999999);
    $rand9 = rand(100000, 9999999);

    $nameimages = array(
        array("name" => "taxi"  , "rand" => $rand1 , "nameold" => $imagetaxiold),
        array("name" => "food"  , "rand" => $rand2 , "nameold" => $imagefoodold),
        array("name" => "pay"   , "rand" => $rand3 , "nameold" => $imagepayold),
        array("name" => "sq"    , "rand" => $rand4 , "nameold" => $imagesendmonyqrcodeold),
        array("name" => "rq"    , "rand" => $rand5 , "nameold" => $imagerecivemoneyqrcodeold),
        array("name" => "sp"    , "rand" => $rand6 , "nameold" => $imagesendmoneyphoneold),
        array("name" => "sa"    , "rand" => $rand7 , "nameold" => $imagestateaccountold),
        array("name" => "charge" , "rand" => $rand8 , "nameold" => $imagemoneychargeold)
    );

    for ($i = 0 ; $i < count($nameimages) ; $i++ ) {

        if (isset($_FILES['taxi']['name'])) {
            $imagetaxi = $rand1 . $_FILES['taxi']['name'];
        } else {
            $imagetaxi = $imagetaxiold;
        }
        
    }

    //    One 
  

    // Two 

    if (isset($_FILES['food']['name'])) {
        $imagefood  = $rand2 . $_FILES['food']['name'];
    } else {
        $imagefood = $imagefoodold;
    }

    // Three 

    if (isset($_FILES['pay']['name'])) {
        $imagepay  = $rand3 . $_FILES['pay']['name'];
    } else {
        $imagepay = $imagepayold;
    }


    // Four 


    if (isset($_FILES['sq']['name'])) {
        $imagesq  = $rand4 . $_FILES['sq']['name'];
    } else {
        $imagesq = $imagesendmonyqrcodeold;
    }

    // Five 



    if (isset($_FILES['rq']['name'])) {
        $imagerq  = $rand5 . $_FILES['rq']['name'];
    } else {
        $imagerq = $imagerecivemoneyqrcodeold;
    }

    // Six 


    if (isset($_FILES['sp']['name'])) {
        $imagesp  = $rand6 . $_FILES['sp']['name'];
    } else {
        $imagesp = $imagesendmoneyphoneold;
    }


    // Seven


    if (isset($_FILES['sa']['name'])) {
        $imagesa  = $rand7 . $_FILES['sa']['name'];
    } else {
        $imagesa = $imagestateaccountold;
    }

    // eight


    if (isset($_FILES['charge']['name'])) {
        $imagecharge  = $rand8 . $_FILES['charge']['name'];
    } else {
        $imagecharge = $imagemoneychargeold;
    }





    // $imagefood   = $_FILES['food']['name']   ?? $imagefoodold;
    // $imagepay    = $_FILES['pay']['name']    ?? $imagepayold;
    // $imagesq     = $_FILES['sq']['name']     ?? $imagesendmonyqrcodeold;
    // $imagerq     = $_FILES['rq']['name']     ?? $imagerecivemoneyqrcodeold;
    // $imagesp     = $_FILES['sp']['name']     ?? $imagesendmoneyphoneold;
    // $imagesa     = $_FILES['sa']['name']     ?? $imagestateaccountold;
    // $imagecharge = $_FILES['charge']['name'] ?? $imagemoneychargeold;


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
            $filename =     $rand1 .    $file['name'];
            if (file_exists("../upload/home/" . $imagetaxiold)) {
                unlink("../upload/home/" . $imagetaxiold);
            }
            move_uploaded_file($file["tmp_name"], "../upload/home/" .     $filename);
        }

        if (isset($_FILES['food']['name'])) {
            $file = $_FILES["food"];
            $filename =  $rand2 . $file['name'];
            unlink("../upload/home/" . $imagefoodold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" .     $filename);
        }

        if (isset($_FILES['pay']['name'])) {
            $file = $_FILES["pay"];
            $filename =   $rand3 . $file['name'];
            unlink("../upload/home/" . $imagepayold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['sq']['name'])) {
            $file = $_FILES["sq"];
            $filename = $rand4 .   $file['name'];
            unlink("../upload/home/" . $imagesendmonyqrcodeold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['rq']['name'])) {
            $file = $_FILES["rq"];
            $filename = $rand5 .   $file['name'];
            unlink("../upload/home/" . $imagerecivemoneyqrcodeold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['sp']['name'])) {
            $file = $_FILES["sp"];
            $filename =  $rand6 .  $file['name'];
            unlink("../upload/home/" . $imagesendmoneyphoneold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['sa']['name'])) {
            $file = $_FILES["sa"];
            $filename =  $rand7 .  $file['name'];
            unlink("../upload/home/" . $imagestateaccountold);
            move_uploaded_file($file["tmp_name"], "../upload/home/" . $filename);
        }

        if (isset($_FILES['charge']['name'])) {
            $file = $_FILES["charge"];
            $filename = $rand8 .   $file['name'];
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
