<?php 

 include "../connect.php" ; 
 $orderid = $_POST['orderid'] ; 

 $orderuser = $_POST['userorder'] ; 

 $stmt = $con->prepare(" UPDATE orders SET orders_status = 3 WHERE orders_id = ? ") ;
 $stmt->execute(array($orderid));
 $count = $stmt->rowCount() ; 
 if ($count > 0) {
   echo json_encode(array("status" => "success")) ; 
   $title =  "تنبيه" ; 
   $body =  "تم التحضير بنجاح" ; 
   sendNotifySpecificUser($orderuser , $title , $body , ""  , "")  ; 
 }else {
    echo json_encode(array("status" => "faild")) ; 

 }
