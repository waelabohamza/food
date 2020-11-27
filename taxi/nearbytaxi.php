<?php

  include "../connect.php" ;

  $lat  =   "33.637489"   ;
  $long =   "36.306316"   ;


   $stmt = $con->prepare("SELECT    users.username  , users.user_phone  , taxi_model , taxi_image , taxi_price, taxi_mincharge  , taxi_id , taxi_user , 
                (ACOS(COS(RADIANS( $lat  ))
              * COS( RADIANS( taxi.taxi_lat ) )
              * COS( RADIANS( taxi.taxi_long ) - RADIANS( $long) )
              + SIN( RADIANS( $lat ) )
              * SIN( RADIANS( taxi.taxi_lat ) )
          )
        * 6371
        ) AS distance_in_km

  FROM taxi
  INNER JOIN users ON users.user_id  = taxi.taxi_user
  HAVING distance_in_km <= 20
  ORDER BY distance_in_km ASC
  LIMIT 14   ");

   $stmt->execute();

   $categories = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount() ;

   if ($count > 0) {
     echo json_encode($categories) ;
   }else {
     echo json_encode(array(0 => "faild")) ;
   }




?>
