<?php
include "../connect.php" ;

$resorders  =  $_POST['resid'] ;
$ordersid     = $_POST['ordersid'] ;
$usersorders    = $_POST['userid'] ;

$stmt = $con->prepare("UPDATE orders SET   orders_status = 1   WHERE orders_id  = ? ") ;
$stmt->execute(array($ordersid )) ;
$count = $stmt->rowCount() ;
if ($count > 0 ) {

   echo json_encode( array('status' => 'success' ));


   $stmt2 = $con->prepare("SELECT users.username ,   users.role , tokenusers.* FROM users
                           JOIN tokenusers ON tokenusers.tokenusers_user = users.user_id
                           WHERE ( `role` = 3 AND `delivery_res` = $resorders )
                           -- الفكرة الاشخاص يلي بيشتغلو دليفري عن المطعم
                           OR (`role` = 0  AND `user_id` = $usersorders)
                           -- الشخص صاحب الطلبية
                            ") ;
   $stmt2->execute() ;
   $delivers = $stmt2->fetchAll(PDO::FETCH_ASSOC) ;
   foreach ( $delivers as $delivery) {
           $token = $delivery['tokenusers_token'] ;
           if ($delivery['role'] == 0 ) {
             $title = "TalabGoFoodDelivery" ;
             $message = "تم الموافقة على طلبك من المطعم والطلبية الان قيد التوصيل" ;
             sendGCM($title , $message ,$token, $resorders , "orderswait");
           }if ($delivery['role'] == 3 ) {
             $title = "TalabGoDelivery" ;
             $message = "يوجد طلبية بانتظار الموافقة" ;
             sendGCM($title , $message ,$token, $resorders , "home");
           }
   }
}else {
   echo json_encode( array('status' => 'faild'));
}


?>
