<?php

          $latu = 35.361010;//users location 
          $longu = 139.280074;
          $lat1 = 35.364219; //1st 7-11
          $long1 = 139.267804;
          $lat2 = 35.366817; //2nd lawson
          $long2 = 139.272703;
          $lat3 = 35.372509; //3rd Family
          $long3 = 139.271988;
          $lat4 = 35.360643; //4th lawson
          $long4 = 139.275320;
          $lat5 = 35.361172; //5th Daily
          $long5 = 139.269099;
          $R = 6371;


for ($i = 1; $x <= 5; $i++) {
  $deltaLat$i = deg2rad($lat$i - $latu);
  $deltaLong$i = deg2rad($long$i - $longu);
  $a$i = sin($deltaLat$i/2) * sin($deltaLat$i/2) + cos(deg2rad($lat$i)) * cos(deg2rad($latu)) * sin($deltaLong$i/2) * sin($deltaLong$i/2);
  $c$i = 2 * atan2(sqrt($a$i), sqrt(1-$a$i));
  $dis$i = $R * $c$i;
  echo $dis$i;
?>
