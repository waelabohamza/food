<?php

include "connect.php" ;
   $idtoken = "d08H_qbsRTetsyMvMAuZUt:APA91bEOVbRZAzUdnxHcHzUOhnR4ujcLvl5AX_BMEamfGguydOThaGH90J5xHV0JcGC9BBNNezFkrESGV4_z97aOaGivEhE8EmBwugrmj1J3lRS6NzHway9r2PR_DBZ1NVAQYm1eav3_" ;
   $title= "php test" ;
   $message = "test test test test test" ;  
  sendGCM( $title , $message ,  $idtoken, "id", "orderswait") ;



?>
