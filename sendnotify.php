<?php

include "connect.php" ;
for ($i = 0 ; $i < 10  ; $i++ ) {
  $idtocken = "fbMUx_pNReeDPnG-Kk9x9y:APA91bHoan8Hi-86M9BilNPapwF9oXZZhZOznHG7iwfJEbtuwKhfQruANHQa9cYATwIZ5f-Fy7MoO9XJ_9wP2NH4BkTspLuKyj7LkqXvidQ02raySKIgarYtFqpKbyb2OWoRroAJ53cS" ;
  $title = "حنان" ;
  $message = "تصبح على خير احلام سعيدة " ;
  sendGCM( $title , $message ,  $idtocken, "id", "ordersdonedelivery") ;
}


?>
