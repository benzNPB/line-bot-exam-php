<?php
 
$latu = 35.368347;//users location
$longu = 139.268366;
$lat1 = 35.364219; //1st 7-11
$long1 = 139.267804;
$lat2 = 35.366817; //2nd lawson
$long2 = 139.272703;
$lat3 = 35.372509; //3rd Family
$long3 = 139.271988;
$lat4 = 35.366817; //4th lawson
$long4 = 139.272703;
$lat5 = 35.372509; //5th Daily
$long5 = 139.271988;
$R = 6371;
    
   $deltaLat1 = deg2rad($latu - $lat1);
   $deltaLong1 = deg2rad($longu - $long1);
   $deltaLat2 = deg2rad($latu - $lat2);
   $deltaLong2 = deg2rad($longu - $long2);
   $deltaLat3 = deg2rad($latu - $lat3);
   $deltaLong3 = deg2rad($longu - $long3);
   $deltaLat4 = deg2rad($latu - $lat4);
   $deltaLong4 = deg2rad($longu - $long4);
   $deltaLat5 = deg2rad($latu - $lat5);
   $deltaLong5 = deg2rad($longu - $long5);


  $a = sin($deltaLat1/2) * sin($deltaLat1/2) + cos(deg2rad($lat1)) * cos(deg2rad($latu)) * sin($deltaLong1/2) * sin($deltaLong1/2);
  $c = 2 * atan2(sqrt($a), sqrt(1-$a));
  $dis1 = $R * $c;
  $a2 = sin($deltaLat2/2) * sin($deltaLat2/2) + cos(deg2rad($lat2)) * cos(deg2rad($latu)) * sin($deltaLong2/2) * sin($deltaLong2/2);
  $c2 = 2 * atan2(sqrt($a2), sqrt(1-$a2));
  $dis2 = $R * $c2;
  $a = sin($deltaLat3/2) * sin($deltaLat3/2) + cos(deg2rad($lat3)) * cos(deg2rad($latu)) * sin($deltaLong3/2) * sin($deltaLong3/2);
  $c = 2 * atan2(sqrt($a), sqrt(1-$a));
  $dis3 = $R * $c;
  $a2 = sin($deltaLat4/2) * sin($deltaLat4/2) + cos(deg2rad($lat4)) * cos(deg2rad($latu)) * sin($deltaLong4/2) * sin($deltaLong4/2);
  $c2 = 2 * atan2(sqrt($a2), sqrt(1-$a2));
  $dis4 = $R * $c2;
  $a5 = sin($deltaLat5/2) * sin($deltaLat5/2) + cos(deg2rad($lat5)) * cos(deg2rad($latu)) * sin($deltaLong5/2) * sin($deltaLong5/2);
  $c5 = 2 * atan2(sqrt($a), sqrt(1-$a));
  $dis5 = $R * $c;

$dis = min ($dis1,$dis2,$dis3,$dis4,$dis5)
switch ($dis) {
    case $dis == $dis1:
        echo $lat1 ;
        break;
    case $dis == $dis2:
        echo $lat2 ;
        break;
    case $dis == $dis3:
        echo $lat3 ;
        break;
    case $dis == $dis4:
        echo $lat4 ;
        break;
    case $dis == $dis5:
        echo $lat5 ;

?>
