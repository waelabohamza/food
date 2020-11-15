<?php

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




?>
