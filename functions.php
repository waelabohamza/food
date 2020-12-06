<?php

function checkAuthenticate() {
  // if ($_SERVER['PHP_AUTH_USER'] != "TalabGoUser@58421710942258459" ||  $_SERVER['PHP_AUTH_PW'] != "TalabGoPassword@58421710942258459") {
  //   header('WWW-Authenticate: Basic realm="My Realm"');
  //   header('HTTP/1.0 401 Unauthorized');
  //   echo 'Page Not Found';
  //   exit;
  // }
}

function getToken($idpar , $type){

  global $con ;

  if ($type == "users") {
    $stmt = $con->prepare("SELECT user_token FROM  `users`  WHERE user_id = ? ") ;
  }else {
      $stmt = $con->prepare("SELECT res_token FROM  `restaurants`  WHERE res_id = ? ") ;
  }

  $stmt->execute(array($idpar)) ;


  $id  = $stmt->fetchColumn() ;

  return $id  ;

}
function getTokenByPhone($phone){

  global $con ;

  $stmt = $con->prepare("SELECT user_token FROM  `users`  WHERE user_phone = ? ") ;

  $stmt->execute(array($phone)) ;

  $mytoken  = $stmt->fetchColumn() ;

  return $mytoken  ;

}

function getTokenAllAdmin($message , $key  , $value) {

    global $con ;
    $stmt = $con->prepare("SELECT `user_token`  , `role` FROM `users` WHERE  `role` =  1  ") ;
    $stmt->execute() ;
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
    foreach ( $admins as $admin) {
              $token = $admin['user_token'] ;
              $title = "TalabGoAdmin" ;
              sendGCM( $title , $message ,  $token , $key , $value)  ;
    //
     }

}

function getThing (  $table , $where , $value , $and = NULL ) {

    global $con ;

    $stmt = $con->prepare("SELECT * FROM $table WHERE $where = ? $and  ") ;

    $stmt->execute(array($value)) ;

    $count = $stmt->rowCount() ;

    $item = $stmt->fetch() ;

    return $item ;

}
function checkThing (  $table , $where , $value , $and = NULL ) {

    global $con ;

    $stmt = $con->prepare("SELECT * FROM $table WHERE $where = ? $and  ") ;

    $stmt->execute(array($value)) ;

    $count = $stmt->rowCount() ;

    return $count ;

}

 function filterSan ($string , $type = NULL) {

         if ( $type == NULL || $type == "") {
             $type = FILTER_SANITIZE_STRING ;
        }elseif ($type == "number"){
            $type = FILTER_SANITIZE_NUMBER_INT ;
        }elseif ($type == "double") {
          $type = FILTER_SANITIZE_NUMBER_FLOAT ;
        }
         else {
             $type = FILTER_SANITIZE_EMAIL ;

         }

         $filterbefore = filter_var($string , $type);

         $filterafter  = trim($filterbefore);

         return $filterafter ;

       }

       function maxId($maxid , $table) {

        global $con  ;

        $stmt = $con->prepare("SELECT  MAX($maxid) FROM  $table") ;

        $stmt->execute() ;

        $id  = $stmt->fetchColumn() ;

        return $id  ;

       }

 // ====================================================================================
 //  SEND NOTEFICATION API
 //=====================================================================================

function sendGCM($title  , $message, $fcm_id , $p_id, $p_name) {
	//$message = utf8_decode($message);

    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array (
            'registration_ids' => array (
                     $fcm_id
            ),
          'priority' =>'high',
          'content_available' => true,

            'notification' => array (
			       "body" =>  $message,
      		   "title" =>  $title,
			       "click_action" => "FLUTTER_NOTIFICATION_CLICK",
					   "sound" => "default"

            ),
			 'data' => array (
					"page_id" => $p_id ,
					"page_name" => $p_name
//			'message' => 'Hello World!'
            )

    );
    $fields = json_encode ( $fields );

    $headers = array (
           // 'Authorization: key=' . "AIzaSyBUuLepXI4xjIuWBO78hagHX9ntj9j_mU4",
		    'Authorization: key=' . "AAAAgSssFmo:APA91bGgHJgpG-9wuEkNF9lUcyzs7-a1Juc76yXuZ_i6RXmClyDVBcCMNQg790naVCcfoTGZDFfKHjb0wliQAydwlqlL43upNCtohs45kXgv-udqVp339tlgwsNXdJIoMLrIkXCjWdU7",
            'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    return $result;
    curl_close ( $ch );
}


function getIdByThing($idtable , $table , $thing , $value) {


          global $con  ;

          $stmt = $con->prepare("SELECT $idtable FROM $table where $thing = ? ") ;

          $stmt->execute(array($value)) ;

          $id  = $stmt->fetchColumn() ;

          return $id  ;


}


// ====================================================================================
//    ADD  AND Minus Money  FOR  TAXI AND USER AND RESTUARANTS AND Delivery
//=====================================================================================

function removeMoneyById($table , $column  ,  $price , $table_id , $id ) {
 global $con  ;
 $stmt = $con->prepare("UPDATE $table SET $column = $column - $price WHERE $table_id = ?  ") ;
 $stmt->execute(array($id)) ;
 $count = $stmt->rowCount() ;
 return $count ;
}

function addMoneyById($table , $column  ,  $price , $table_id , $id) {
  global $con  ;
  $stmt = $con->prepare("UPDATE $table SET $column = $column + $price WHERE $table_id = ?  ") ;
  $stmt->execute(array($id)) ;
  $count = $stmt->rowCount() ;
  return $count ;
}


// ====================================================================================
//    INSERT TOKEN AND DELETE TOKEN FOR  TAXI AND USER AND RESTUARANTS
//=====================================================================================

function insertTokenRes($resid , $restoken){
  global $con  ;
  $sql  = "INSERT INTO `tokenres`(`tokenres_res`, `tokenres_token`) VALUES ( ?  , ? )"  ;
  $stmt = $con->prepare($sql) ;
  $stmt->execute(array($resid , $restoken)) ;
  $count = $stmt->rowCount()   ;
  return $count ;
}
function insertTokenUser($userid , $usertoken){
  global $con  ;
  $sql  = "INSERT INTO `tokenusers`(`tokenusers_token`,`tokenusers_user`) VALUES (? , ?)"  ;
  $stmt = $con->prepare($sql) ;
  $stmt->execute(array($usertoken , $userid)) ;
  $count = $stmt->rowCount()   ;
  return $count ;
}
function insertTokenTaxi($taxiid , $taxitoken){
  global $con  ;
  $sql  = "INSERT INTO `tokentaxi`( `tokentaxi_token`, `tokentaxi_taxi`) VALUES (? ,  ?)"  ;
  $stmt = $con->prepare($sql) ;
  $stmt->execute(array($taxitoken , $taxiid)) ;
  $count = $stmt->rowCount()   ;
  return $count ;
}


function deleteTokenRes($resid){
  global $con  ;
  $sql  = "DELETE FROM `tokenres` WHERE tokenres_res =  ?"  ;
  $stmt = $con->prepare($sql) ;
  $stmt->execute(array($resid)) ;
  $count = $stmt->rowCount()   ;
  return $count ;
}
function deleteTokenUser($userid){
  global $con  ;
  $sql  = "DELETE FROM `tokenusers` WHERE tokenusers_user = ?"  ;
  $stmt = $con->prepare($sql) ;
  $stmt->execute(array($userid)) ;
  $count = $stmt->rowCount()   ;
  return $count ;
}
function deleteTokenTaxi($taxiid){
  global $con  ;
  $sql  = "DELETE FROM `tokentaxi` WHERE tokentaxi_taxi =  ? "  ;
  $stmt = $con->prepare($sql) ;
  $stmt->execute(array($taxiid)) ;
  $count = $stmt->rowCount()   ;
  return $count ;
}





?>
