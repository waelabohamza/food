<?php

include "connect.php";
$i = 0;
$searcharray = array();
$search = $_POST['search'];
$stmtcat = $con->prepare("SELECT * FROM categories WHERE cat_name LIKE '%$search%' LIMIT 10 ");
$stmtcat->execute();
$countcat = $stmtcat->rowCount();
$datacat = array();


while ($cat = $stmtcat->fetch(PDO::FETCH_ASSOC)) {

    $datacat['cat_name'] = $cat['cat_name'];
    $datacat['cat_id'] = $cat['cat_id'];
    $datacat['cat_image'] = $cat['cat_photo'];

    $searcharray[$i]['type_name'] = $cat['cat_name'];
    $searcharray[$i]['type_id'] = $cat['cat_id'];
    $searcharray[$i]['type'] = "categories";
    $searcharray[$i]['data'] = $datacat;


    $i++;
}
$stmtres = $con->prepare("SELECT * FROM restaurants WHERE res_name LIKE '%$search%' LIMIT 10 ");
$stmtres->execute();
$countres = $stmtres->rowCount();

$datares = array();



while ($res = $stmtres->fetch(PDO::FETCH_ASSOC)) {

    $datares['res_name'] = $res['res_name'];
    $datares['res_id'] = $res['res_id'];
    $datares['res_price_delivery'] = $res['res_price_delivery'];
    $datares['res_description'] = $res['res_description'];
    $datares['res_time_delivery'] = $res['res_time_delivery'];
    $datares['res_area'] = $res['res_area'];
    $datares['res_image'] = $res['res_image'];

    $searcharray[$i]['type_name'] = $res['res_name'];
    $searcharray[$i]['type_id'] = $res['res_id'];
    $searcharray[$i]['type'] = "resturants";
    $searcharray[$i]['data']    = $datares;


    $i++;
}

$stmtitem = $con->prepare("SELECT items.* , categories.* , restaurants.*
FROM items
INNER JOIN categories
ON items.item_cat = categories.cat_id
INNER JOIN restaurants
ON items.item_res = restaurants.res_id
WHERE item_name LIKE '%$search%' LIMIT 10 ");
$stmtitem->execute();
$countitem = $stmtitem->rowCount();
$dataitems = array();


while ($item = $stmtitem->fetch(PDO::FETCH_ASSOC)) {

    $dataitems['item_id'] = $item['item_id'];
    $dataitems['item_name'] = $item['item_name'];
    $dataitems['item_description'] = $item['item_description'];
    $dataitems['item_image'] = $item['item_image'];
    $dataitems['item_price'] = $item['item_price'];
    $dataitems['res_price_delivery'] = $item['res_price_delivery'];
    $dataitems['res_time_delivery'] = $item['res_time_delivery'];
    $dataitems['res_id'] = $item['res_id'];
 

    $searcharray[$i]['type_name'] = $item['item_name'];
    $searcharray[$i]['type_id'] = $item['item_id'];
    $searcharray[$i]['type'] = "items";
    $searcharray[$i]['data'] = $dataitems;


    $i++;
}

if ($countcat > 0 || $countres > 0 || $countitem > 0) {
    echo json_encode($searcharray);
}else {
    echo json_encode(array(0 => "faild"));

}


// echo "<pre>";

// print_r($searcharray);

// echo "</pre>";
