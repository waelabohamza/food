<?php

include "connect.php" ;
$idtocken = "ds5KjEqxRAi-mjN4yo9FHM:APA91bH7kUgN2-7sx0hZTu-vI6Yk2Dyj2BrkLVWMq3Wj4nqQikl7i89z3QdMJALZMNkuXOurTbKeCEjKBfHfCUjz3FZ2uDJ5FN_9eXKBQpl89OvQL5k6T-VwI02r-nFQtvVLRzu9m7Q7" ;
$title = "TalabGoDelivery" ;
$message = "Test Test Test Test " ;
sendGCM( $title , $message ,  $idtocken, "id", "ordersdonedelivery") ;

?>
