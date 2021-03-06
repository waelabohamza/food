<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$itemdesc = $_POST['itemdesc'];
$itemname = $_POST['item_name']       ;
$itemnameen = $_POST['item_name_en']  ;
$catname = trim($_POST['cat_name'])   ;

$stmt2 = $con->prepare("SELECT * FROM categories WHERE cat_name = ? ") ;
$stmt2->execute(array($catname)) ;
$cats = $stmt2->fetch() ;

if (!isset($_POST['itemres'])) {
  $resname = trim($_POST['res_name']) ;
  $stmt3 = $con->prepare("SELECT * FROM restaurants WHERE res_name = ? ") ;
  $stmt3->execute(array($resname)) ;
  $res = $stmt3->fetch() ;
  $itemres = $res['res_id'] ;
}else {
  $itemres = $_POST['itemres'] ;
}



$itemcat = $cats['cat_id'] ;

// $itemcat = $_POST['item_cat'];

$itemsize = 1 ;



$itemprice = $_POST['item_price'] ;


$imagename =  rand(1000 , 2000) . $_FILES['file']['name'];


$sql = "INSERT INTO `items`(  `item_name` , `item_name_en`, `item_size`, `item_price`, `item_image`, `item_cat` , `item_res`  , `item_description`)
        VALUES (? , ?  , ? ,  ? , ? ,  ? , ? , ?)" ;

$stmt = $con->prepare($sql) ;
$stmt->execute(array($itemname , $itemnameen , $itemsize , $itemprice ,   $imagename , $itemcat , $itemres , $itemdesc));

$count = $stmt->rowCount() ;

if ($count > 0) {

  move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/items/". $imagename );

	echo json_encode(array("status" => "success add")) ;

}else {

	echo json_encode(array("status" => "faild ")) ;

}
}
?>
