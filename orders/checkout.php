<?php
include "../connect.php" ;
$data = json_decode(file_get_contents('php://input'), true);
 $userid      = $data['userid'] ;
 $totalprice  = $data['totalprice'] ;
 $lat         = $data['lat']  ;
 $long        = $data['long'] ;
 $timenow     = $data['timenow'];
 $description  = "تجربة"  ;
 $address  = "تجربة"  ;
 $sql = "INSERT INTO `orders` (`orders_users`, `orders_description`, `orders_lat`,
                               `orders_long`, `orders_address`, `orders_date`,
                               `orders_total`, `orders_status`)
 VALUES(:us , :des , :lat , :long  , :ad , :dat , :tot , :st ) ";
 $stmt = $con->prepare($sql) ;
 $stmt->execute(array(
   ":us"      => $userid        ,
   ":des"     => $description       ,
   ":lat"     => $lat           ,
   ":long"    => $long          ,
   ":ad"      =>  $address     ,
   ":dat"     => $timenow       ,
   ":tot"     => $totalprice    ,
   ":st"      => "0"
 )) ;
 $count = $stmt->rowCount();
 $orderid = maxId("orders_id" , "orders")     ;
 if ($count > 0) {
      for ( $i = 0 ; $i < count($data['listfood']) ; $i++  ) {
         // echo $data['listfood'][$i]['item_id']   .  " " . $data['quantity'][$data['listfood'][$i]['item_id']] . " <br/> ";
         $itemid = $data['listfood'][$i]['item_id']  ;
         $quantity =  $data['quantity'][$data['listfood'][$i]['item_id']] ;
         $resid =   $data['listfood'][$i]['res_id']  ;
         $stmt2 = $con->prepare("INSERT INTO `orders_details`(`details_order`, `details_item`, `details_quantity` , `details_res`)
                                 VALUES (   ? ,  ?  , ?   , ? ) ") ;
          $stmt2->execute(array($orderid , $itemid , $quantity , $resid)) ;
       }
       $count2 = $stmt2->rowCount()  ;
       if ($count2 > 0 ) {
         // increase balance resturants and remove balance user
         $resprice = $data['resprice'] ;
         print_r($resprice) ;
          foreach ($resprice as $key => $value) {
            // code...
            $resid  = $key ;
            $addbalance   = $value ;
            $stmt3 = $con->prepare(" UPDATE `restaurants` SET  `res_balance`  =  `res_balance` +  $value WHERE `res_id` = $key  ") ;
            $stmt3->execute() ;
          }
          $count3  = $stmt3->rowCount() ;
          $stmt4  = $con->prepare("UPDATE `users` SET  `user_balance` = `user_balance` - $totalprice  WHERE `user_id` = $userid ") ;
          $stmt4->execute() ;
          $count4 = $stmt4->rowCount() ;
          if ($count3 > 0 && $count4 > 0 ) {
            echo "yes success"  ;
          }
       }
 }
?>
