<?php
include "../connect.php" ;

$deliveryid   = $_POST['deliveyid'] ;
$ordersid     = $_POST['ordersid']  ;
$userid       = $_POST['userid']    ;
$resid        = $_POST['resid']     ;


$stmt = $con->prepare("UPDATE orders SET orders_delivery = ?  , orders_status = 2   WHERE orders_id  = ? AND  orders_status = 1") ;
$stmt->execute(array($deliveryid  ,  $ordersid )) ;
$count = $stmt->rowCount() ;
if ($count > 0 ){

   echo json_encode( array('status' => 'success' ));

   $title       =   "TalabGoFoodDelivery"  ;
   $message     =   "تم استلام الطلبية من قبل عامل التوصيل والطلبية الان على الطريق " ;
   sendNotifySpecificUser($userid , $title ,  $message , "id" , "orderswait" ) ;
   $title       =   "TalabGoRestaurants"  ;
   $message     =  "تم استلام الطلبية رقم"   . $ordersid  . "من قبل عامل التوصيل والطلبية الان على الطريق ";
   sendNotifySpecificRes($resid ,  $title ,  $message ,  "id" , "orders" ) ;

   // من اجل تحديث بيانات كل عامل توصيل

   $stmt2 = $con->prepare("SELECT users.username ,   users.role , tokenusers.* FROM users
                           JOIN tokenusers ON tokenusers.tokenusers_user = users.user_id
                           WHERE  `role` = 3
                           AND `delivery_res` = $resid
                           AND user_id != $deliveryid
                            -- الفكرة الاشخاص يلي بيشتغلو دليفري عن المطعم
                            ") ;
   $stmt2->execute() ;
   $delivers = $stmt2->fetchAll(PDO::FETCH_ASSOC) ;
   foreach ( $delivers as $delivery) {
             $token = $delivery['tokenusers_token'] ;
             $title = "TalabGoDelivery" ;
             $message =  "تم استلام الطلبية رقم  "  . $ordersid . " من قبل عامل توصيل اخر  " ;
             sendGCM( $title , $message ,  $token , "id", "home")  ;
   //
    }

}else {
   echo json_encode( array('status' => 'faild'));
}
?>
