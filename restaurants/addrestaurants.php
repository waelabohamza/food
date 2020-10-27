<?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $name           =   filter_var($_POST['res_name'] , FILTER_SANITIZE_STRING) ;
  $email          =   filter_var($_POST['res_email'] , FILTER_SANITIZE_EMAIL);
  $timedelivery   =   filterSan($_POST['timedelivery'] , "number");
  $pricedelivery  =   $_POST['pricedelivery'];
  $description    =   filterSan($_POST['description']);
  $type           =   filterSan($_POST['type']);
  $password       =   $_POST['res_password'] ;
  $phone          =   filterSan($_POST['phone'] , "number") ;

  // Start Images

  $imagenamelogo =   rand(1000 , 2000) .   $_FILES['file']['name'] ;

  $imagenamelisence =   rand(1000 , 2000) .  $_FILES['filetwo']['name'] ;

  // check if user excist

  $stmtcheck = $con->prepare("SELECT * FROM restaurants WHERE res_email = ? OR res_phone = ? ");
  $stmtcheck->execute(array($email  ,$phone)) ;
  $row = $stmtcheck->rowcount() ;
  if ($row > 0 ) {
    echo json_encode(array('status' => "email already found"));
  }else { // if user not exist =>  not rigister => start register
    $stmt   = $con->prepare("INSERT INTO restaurants(`res_name` , `res_email` , `res_password` , `res_image` , `res_lisence` ,
                                                     `res_time_delivery` ,  `res_price_delivery`  , `res_description` , `res_type`
                                                     , `res_phone` , `res_approve` ) VALUES (:na , :em , :pa , :im , :lis , :tim , :pr , :des , :ty , :ph , 1)") ;
    $stmt->execute(array(
      ':na'   =>  $name ,
      ':em'   =>  $email ,
      ':pa'   =>  $password ,
      ':im'   =>  $imagenamelogo ,
      ':lis'  =>  $imagenamelisence ,
      ':tim'  =>  $timedelivery ,
      ':pr'   =>  $pricedelivery ,
      ':ty'   =>  $type ,
      ':des'  =>  $description ,
      ':ph'   =>  $phone
    )) ;
    $row = $stmt->rowcount() ;
    if ($row > 0) {
      // echo "success" ;
	      move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/reslogo/". $imagenamelogo );
    	  move_uploaded_file($_FILES["filetwo"]["tmp_name"], "../upload/reslisence/". $imagenamelisence );
      echo json_encode(array('res_name' => $name ,'res_email' => $email ,'res_password' => $password , 'status' => "success"));
    }
  }
  // End Check
}
?>
