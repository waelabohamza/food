<?php
include "../connect.php";
$id  =   getIdByThing("user_id" , "users" , "email" , "wael@gmail.com");
echo $id  ;
?>
