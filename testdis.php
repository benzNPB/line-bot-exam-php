<?php
 
//$latu = 35.368347;//users location (秦野市立大根中学校)
//$longu = 139.268366;
$latu = 35.361010;//users location (金目親水公園)
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
    
   $deltaLat1 = deg2rad($lat1 - $latu);
   $deltaLong1 = deg2rad($long1 - $longu);
   $deltaLat2 = deg2rad($lat2 - $latu);
   $deltaLong2 = deg2rad($long2 - $longu);
   $deltaLat3 = deg2rad($lat3 - $latu);
   $deltaLong3 = deg2rad($long3 - $longu);
   $deltaLat4 = deg2rad($lat4 - $latu);
   $deltaLong4 = deg2rad($long4 - $longu);
   $deltaLat5 = deg2rad($lat5 - $latu);
   $deltaLong5 = deg2rad($long5 - $longu);


  $a1 = sin($deltaLat1/2) * sin($deltaLat1/2) + cos(deg2rad($lat1)) * cos(deg2rad($latu)) * sin($deltaLong1/2) * sin($deltaLong1/2);
  $c1 = 2 * atan2(sqrt($a1), sqrt(1-$a1));
  $dis1 = $R * $c1;
  $a2 = sin($deltaLat2/2) * sin($deltaLat2/2) + cos(deg2rad($lat2)) * cos(deg2rad($latu)) * sin($deltaLong2/2) * sin($deltaLong2/2);
  $c2 = 2 * atan2(sqrt($a2), sqrt(1-$a2));
  $dis2 = $R * $c2;
  $a3 = sin($deltaLat3/2) * sin($deltaLat3/2) + cos(deg2rad($lat3)) * cos(deg2rad($latu)) * sin($deltaLong3/2) * sin($deltaLong3/2);
  $c3 = 2 * atan2(sqrt($a3), sqrt(1-$a3));
  $dis3 = $R * $c3;
  $a4 = sin($deltaLat4/2) * sin($deltaLat4/2) + cos(deg2rad($lat4)) * cos(deg2rad($latu)) * sin($deltaLong4/2) * sin($deltaLong4/2);
  $c4 = 2 * atan2(sqrt($a4), sqrt(1-$a4));
  $dis4 = $R * $c4;
  $a5 = sin($deltaLat5/2) * sin($deltaLat5/2) + cos(deg2rad($lat5)) * cos(deg2rad($latu)) * sin($deltaLong5/2) * sin($deltaLong5/2);
  $c5 = 2 * atan2(sqrt($a5), sqrt(1-$a5));
  $dis5 = $R * $c5;

$dis = array ($dis1,$dis2,$dis3,$dis4,$dis5);
sort($dis);
$dis[0];
$dis[1];
        echo $dis[0] . "<br>";
        echo $dis[1] ;


?>
