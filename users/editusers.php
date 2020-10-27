<?php

include "../connect.php" ;

if ($_SERVER['REQUEST_METHOD'] == "POST"){

$username = filterSan($_POST['username']) ;

$email = filterSan($_POST['email'] , "email") ;

$password = $_POST['password'] ;

$phone  = filterSan(intval($_POST['phone'])  , "number");

$userid = $_POST['userid'] ;

$usercheck = getThing("users" , "user_id" , $userid) ;

$imageold = $usercheck['user_image'] ;


if (isset(($_FILES['file']))) {

  	 $imagename =   $_FILES['file']['name'];

      $stmt = $con->prepare("UPDATE `users`
     	                    SET `username`= ? ,
                              `user_image`= ? ,
                              `password` = ?  ,
                              `email`  = ? ,
                              `user_phone` = ?
     	                    WHERE `user_id` = ?
     	                    ");

     $stmt->execute(array($username , $imagename ,  $password , $email , $phone , $userid)) ;

     $count = $stmt->rowCount() ;

     if ($count > 0 ) {

     	   if (file_exists("../upload/users/" . $imageold )){
              unlink("../upload/users/" . $imageold) ;
			 }
		    move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/users/". $imagename );

		   echo json_encode(array("status" => "Success" , "username" => $username , "email" => $email , "phone" => $phone , "password" => $password)) ;

     } else {

     	   echo json_encode(array("status" => "Faild Edit Image")) ;

     }


}else {

	  $stmt = $con->prepare("UPDATE `users`
     	                    SET   `username`= ? ,
                                `password` = ? ,
                                `email` = ? ,
                                `user_phone` = ?
     	                    WHERE
                                 `user_id` = ?
     	                    ") ;
     $stmt->execute(array($username , $password , $email  , $phone   , $userid)) ;

     $count = $stmt->rowCount() ;

     if ($count > 0 ) {
     	   echo json_encode(array("status" => "Success" , "username" => $username , "email" => $email , "phone" => $phone , "password" => $password)) ;
     }else {
     	   echo json_encode(array("status" => "Faild")) ;
     }
  }
}

?>
