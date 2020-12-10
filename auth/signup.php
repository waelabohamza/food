<?php
include "../connect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  $imagename = rand(1000 , 2000)  . $_FILES['file']['name'];

  $username  = filter_var($_POST['username'] , FILTER_SANITIZE_STRING) ;

  $email     = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);

  $password  =  $_POST['password'] ;

  $phone   =  filterSan($_POST['phone'] , "number") ;



  // check if user excist

  $stmtcheck = $con->prepare("SELECT * FROM users WHERE email = ? OR user_phone = ? ");
  $stmtcheck->execute(array($email , $phone)) ;
  $row = $stmtcheck->rowcount() ;
  if ($row > 0 ) {
    echo json_encode(array('status' => "email OR phone already found"));
  }else {
    // if user not exist =>  not rigister => start register

    if (isset($_POST['role'])) {

      $role = $_POST['role'] ;

      $stmt   = $con->prepare("INSERT INTO users(`username` , `email` , `password`,`user_phone`, `user_image` , `role`)
                               VALUES           (? , ? , ? , ? , ? , ?)") ;

      $stmt->execute(array($username , $email , $password  , $phone , $imagename , $role)) ;

      $row = $stmt->rowcount() ;

    }else {
      $stmt   = $con->prepare("INSERT INTO users(`username` , `email` , `password`,`user_phone`, `user_image`)
                               VALUES           (? , ? , ? , ? , ?)") ;

      $stmt->execute(array($username , $email , $password  , $phone , $imagename)) ;

      $row = $stmt->rowcount() ;
    }



    if ($row > 0) {
      // echo "success" ;
      move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/users/". $imagename );
      
      echo json_encode(array('username' => $username ,'email' => $email ,'password' => $password , 'status' => "success"));
    }

  }
  // End Check
}
?>
