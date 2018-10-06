<?php

$lat1 = 35.372331;
$long1 = 139.269988;
$lat2 = 35.372896;
$long2 =139.270909;
$R = 6371;
$Δlat = $lat1 - $lat2;
$Δlong = $long1 - $long2;
$a = sin²($Δlat /2) + cos($lat1)*cos($lat2)*sin²($Δlong/2);
$c = 2*$a*tan2(√$a, √(1−$a));
$d = $R*$c;
echo $d
?>
