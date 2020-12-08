<?php

  include "../connect.php" ;

  $lat  =   $_POST['lat'] ;
  $long =   $_POST['long']  ;

   $stmt = $con->prepare("SELECT    taxi_username ,
                                    taxi_phone ,
                                    taxi_model ,
                                    taxi_image ,
                                    taxi_price,
                                    taxi_mincharge  ,
                                    taxi_id ,
                                  
                (ACOS(COS(RADIANS( $lat  ))
              * COS( RADIANS( taxi.taxi_lat ) )
              * COS( RADIANS( taxi.taxi_long ) - RADIANS( $long) )
              + SIN( RADIANS( $lat ) )
              * SIN( RADIANS( taxi.taxi_lat ) )
          )
        * 6371
        ) AS distance_in_km
  FROM taxi
  WHERE taxi_active = 1
  HAVING distance_in_km <= 200
  ORDER BY distance_in_km ASC
  LIMIT 14
   ");

   $stmt->execute();

   $categories = $stmt->fetchall(PDO::FETCH_ASSOC);

   $count = $stmt->rowCount() ;

   if ($count > 0) {
     echo json_encode($categories) ;
   }else {
     echo json_encode(array(0 => "faild")) ;
   }

?>
