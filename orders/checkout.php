<?php
include "../connect.php" ;
$data = json_decode(file_get_contents('php://input'), true);

$resid      = $data['resid']      ;
$userid     = $data['userid']     ;
$totalprice = $data['totalprice'] ;
$lat        = $data['lat']        ;
$long       = $data['long']       ;
$timenow    = $data['timenow']    ;
$description  = "تجربة"  ;
$address  = "تجربة"  ;
$type = $data['type'] ;

$sql = "INSERT INTO `orders` (`orders_users`,`orders_res` ,  `orders_description`, `orders_lat`,
                              `orders_long`, `orders_address`, `orders_date`,
                              `orders_total`, `orders_status` , `orders_type`)
VALUES(:us , :res , :des , :lat , :long  , :ad , :dat , :tot , :st  , :ty ) ";
$stmt = $con->prepare($sql) ;
$stmt->execute(array(
  ":us"      => $userid        ,
  ":res"     => $resid         ,
  ":des"     => $description   ,
  ":lat"     => $lat           ,
  ":long"    => $long          ,
  ":ad"      => $address       ,
  ":dat"     => $timenow       ,
  ":tot"     => $totalprice    ,
  ":st"      => "0"            ,
  ":ty"      => $type
)) ;
$count = $stmt->rowCount();
$orderid = maxId("orders_id" , "orders")     ;
if ($count > 0) {
     for ( $i = 0 ; $i < count($data['listfood']) ; $i++  ) {
        // echo $data['listfood'][$i]['item_id']   .  " " . $data['quantity'][$data['listfood'][$i]['item_id']] . " <br/> ";
        $itemid =   $data['listfood'][$i]['item_id']  ;
        $quantity =  $data['quantity'][$data['listfood'][$i]['item_id']] ;
        $stmt2 = $con->prepare("INSERT INTO `orders_details`(`details_order`, `details_item`, `details_quantity`  )
                                VALUES (   ? ,  ?  , ?   ) ") ;
         $stmt2->execute(array($orderid , $itemid , $quantity  )) ;
      }
      $count2 = $stmt2->rowCount()  ;
      if ($count2 > 0 ) {
         $stmt3 = $con->prepare(" UPDATE `restaurants` SET  `res_balance`  =  `res_balance` +  $totalprice WHERE `res_id` = $resid  ") ;
         $stmt3->execute() ;
         $count3  = $stmt3->rowCount() ;
         $stmt4  = $con->prepare("UPDATE `users` SET  `user_balance` = `user_balance` - $totalprice  WHERE `user_id` = $userid ") ;
         $stmt4->execute() ;
         $count4 = $stmt4->rowCount() ;
         if ($count3 > 0 && $count4 > 0 ) {
           $title = "TalabGoRestaurants" ;
           $message = "يوجد طلبية بانتظار الموافقة" ;
           sendNotifySpecificRes($resid ,  $title , $message , $resid , "orders" ) ;
         }
      }
}



?>
