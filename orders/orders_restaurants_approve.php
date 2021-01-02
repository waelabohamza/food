<?php
include "../connect.php" ;

     $resorders  =  $_POST['resid'] ;
     $ordersid     = $_POST['ordersid'] ;
     $usersorders    = $_POST['userid'] ;
     $type = $_POST['type'] ;
     $stmt = $con->prepare("UPDATE orders SET   orders_status = 1   WHERE orders_id  = ? ") ;
     $stmt->execute(array($ordersid )) ;
     $count = $stmt->rowCount() ;
     if ($count > 0 ){
        echo json_encode( array('status' => 'success' ));
       if($type == "delivery") {
         // Start Send Message to Delivery
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
                   insertNotifySpecifcCatInDatabase($title  , $message , 2  , "" , "orders"  ) ; 
                 }if ($delivery['role'] == 3 ) {
                   $title = "TalabGoDelivery" ;
                   $message = "يوجد طلبية بانتظار الموافقة" ;
                   sendGCM($title , $message ,$token, $resorders , "home");
                 }
         }
        // End Send Message
      }elseif ($type != "delivery"){
        $title = "TalabGoFoodDelivery" ;
        $message = "تم الموافقة على طلبك من المطعم والطلبية الان قيد التحضير" ;
        sendNotifySpecificUser($usersorders ,$title , $message , "" , "" ) ; 
      }else {
      }
     }
     else {
        echo json_encode( array('status' => 'faild'));
     }
// End Delivery Type
// 0 بانتظار موافقة المطعم
// 1 تم الموافقة من خلال المطعم على الطلب
// 2 تم الموافقة على الطلب من قبل عامل التوصيل
// 3 تم التوصيل
// في حال كان الطلب نوعه طاولة او استلام لايوجد 2 وانما مباشرة 3
