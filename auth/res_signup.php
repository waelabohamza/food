<?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $username = filter_var($_POST['res_name'] , FILTER_SANITIZE_STRING) ;
  $email    = filter_var($_POST['res_email'] , FILTER_SANITIZE_EMAIL);
  $password =  $_POST['res_password'] ;
  $phone = intval($_POST['res_phone']) ;

  // Start Images

  $imagenamelogo =   rand(1000 , 2000) .   $_FILES['file']['name'] ;

  $imagenamelisence =   rand(1000 , 2000) .   $_FILES['filetwo']['name'] ;



  // check if user excist

  $stmtcheck = $con->prepare("SELECT * FROM restaurants WHERE res_email = ? OR res_phone = ? ");
  $stmtcheck->execute(array($email , $phone)) ;
  $row = $stmtcheck->rowcount() ;
  if ($row > 0 ) {
    echo json_encode(array('status' => "email OR phone already found"));
  }else { // if user not exist =>  not rigister => start register
    $stmt   = $con->prepare("INSERT INTO restaurants(`res_name` , `res_email` , `res_phone` , `res_password` , `res_image` , `res_lisence`) VALUES (? , ? , ? ,  ? , ?   , ?)") ;
    $stmt->execute(array($username , $email , $phone , $password , $imagenamelogo , $imagenamelisence)) ;
    $row = $stmt->rowcount() ;
    if ($row > 0) {
      // echo "success" ;
      move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/reslogo/". $imagenamelogo );
      move_uploaded_file($_FILES["filetwo"]["tmp_name"], "../upload/reslisence/". $imagenamelisence );

      echo json_encode(array('res_name' => $username ,'res_email' => $email ,'res_password' => $password , 'status' => "success"));
    }
  }
  // End Check
}
?>
