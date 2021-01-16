<?php

include "../connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$itemid = $_POST['itemid'];

	$itemname = $_POST['item_name'];

	$itemnameen = $_POST['item_name_en'];



	$catname = trim($_POST['cat_name']);

	$stmt2 = $con->prepare("SELECT * FROM categories WHERE cat_name = ? ");
	$stmt2->execute(array($catname));
	$cats = $stmt2->fetch();
	$count2 = $stmt2->rowCount();

	if ($count2 > 0) {

		$itemcat = $cats['cat_id'];



		$itemsize = 1;


		$itemprice = $_POST['item_price'];

		$itemcheck = getThing("items", "item_id", $itemid);
		$imageold = $itemcheck['item_image'];





		if (isset($_FILES['file'])) {

			$imagename =  $_FILES['file']['name'];



			$sql = "UPDATE `items` SET
			      `item_name`	= :itn ,
				  `item_name_en` = :naen , 
			      `item_size`	= :its ,
			      `item_price`	= :itp ,
			      `item_image`	= :itimg ,
			      `item_cat`	= :itc
			       WHERE `item_id`=  :itid ";

			$stmt = $con->prepare($sql);
			$stmt->execute(array(
				":itn" 		  => $itemname,
				":naen"      => $itemnameen,
				":its" 		  => $itemsize,
				":itp" 		  => $itemprice,
				":itimg"	  => $imagename,
				":itc"      => $itemcat,
				":itid"     => $itemid
			));

			if (file_exists("../upload/items/" . $imageold)) {
				unlink("../upload/items/" . $imageold);
			}

			move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/items/" . $imagename);
		} else {

			$sql = "UPDATE `items` SET
			      `item_name`	= :itn ,
				  `item_name_en` = :naen , 
			      `item_size`	= :its ,
			      `item_price`	= :itp ,
			      `item_cat`	= :itc
			       WHERE `item_id`=  :itid ";

			$stmt = $con->prepare($sql);
			$stmt->execute(array(
				":itn" 		=> $itemname,
				":naen"      => $itemnameen,
				":its" 		=> $itemsize,
				":itp" 		=> $itemprice,
				":itc"      => $itemcat,
				":itid"     => $itemid
			));
		}





		$count = $stmt->rowCount();

		if ($count > 0) {

			echo json_encode(array("status" => "success Edit"));
		} else {

			echo json_encode(array("status" => "No Update "));
		}
	} else {
		echo json_encode(array("status" => " Faild  "));
	}
}
