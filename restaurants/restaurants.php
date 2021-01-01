<?php

include "../connect.php";

$and = null;

if (isset($_POST['resapprove'])) {
  $value = $_POST['resapprove'];
  $where = "WHERE res_approve = '$value' ";
} elseif (isset($_POST['resid'])) {
  $value = $_POST['resid'];
  $where = "WHERE res_id  = '$value' ";
} else {
  $where = "WHERE res_approve  = 1";
}

if (isset($_POST['type'])) {
  $type = $_POST['type'];
  if ($type == "all") {
    $and = null;
  } else {
    $and = "AND res_type = '$type' ";
  }
} else {
  $and = null;
}

$stmt = $con->prepare("SELECT   restaurants.* , catsres.catsres_name   FROM `restaurants`
    INNER JOIN catsres ON catsres.catsres_id  = restaurants.res_type
    $where $and ");

$stmt->execute();

if (isset($_POST['resid'])) {

  $restaurants = $stmt->fetch(PDO::FETCH_ASSOC);
} else {

  $restaurants = $stmt->fetchall(PDO::FETCH_ASSOC);
}

$count = $stmt->rowCount();

if ($count > 0) {
  echo json_encode($restaurants);
} else {
  echo json_encode(array("0" => "faild"));
}
