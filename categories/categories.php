<?php
include "../connect.php" ;

  if (isset($_POST['type'])) {

    $type =   $_POST['type'] ;

    $where = "WHERE cat_type =  $type " ;

  }else{

    $where = "WHERE cat_type = 0" ;

    }

  if (isset($_GET['type'])) {

    $type =   $_GET['type'] ; 

    $where = "WHERE cat_type =  $type " ;

  }


   $stmt = $con->prepare("SELECT   * FROM `categories`  $where ");

   $stmt->execute();

   $categories = $stmt->fetchall(PDO::FETCH_ASSOC);

   echo json_encode($categories) ;

?>
