<?php

 include 'connect.php';

$image = $_FILES['file']['name'];

// $cus_name = $_POST["title"];

move_uploaded_file($_FILES["file"]["tmp_name"], "upload/". $image );

// $insert_array = array();
//
// 	array_push($insert_array , $image);
// 	array_push($insert_array , $cus_name);
//
//
// 	$sql_m = "insert into customer (cus_image , cus_name) values(?,?)";
// 	dbQuery_PDO($sql_m , $insert_array );

?>
