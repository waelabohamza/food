<?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $imagename = rand(1000 , 2000) . $_FILES['file']['name'] ;

  $username  = filterSan($_POST['username']) ;
  $email     = filterSan($_POST['email'] , "email");
  $password  =  $_POST['password'] ;
  $phone     = filterSan($_POST['phone'] , "number");

  // check if user excist

  $stmtcheck = $con->prepare("SELECT * FROM users WHERE email = ? OR user_phone = ?");
  $stmtcheck->execute(array($email , $phone )) ;
  $row = $stmtcheck->rowcount() ;
  if ($row > 0 ) {
    echo json_encode(array('status' => "Email OR phone already exists"));
  }else { // if user not exist =>  not rigister => start register
    $stmt   = $con->prepare("INSERT INTO
                       users(`username` , `email` , `password` , `user_phone` , `user_image` )
                       VALUES (? , ? , ? , ? , ?)") ;
    $stmt->execute(array($username , $email , $password , $phone  , $imagename )) ;
    $row = $stmt->rowcount() ;
    if ($row > 0) {
      // echo "success" ;
     move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/users/". $imagename );
      echo json_encode(array('username' => $username ,'email' => $email ,'password' => $password , 'status' => "success"));
    }
  }
  // End Check
}
?>
