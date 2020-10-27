<?php


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


?>
