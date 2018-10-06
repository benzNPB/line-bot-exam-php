<?php		
$lat1 = 35.372331;
$long1 = 139.269988;
$lat2 = 35.372896;
$long2 =139.270909;
$R = 6,371;
$lat = $lat1 - $lat2;
$long = $long1 - $long2;
$a = sin²($lat /2) + cos($lat1)*cos($lat2)*sin²($long/2);
$c = 2*$a*tan2(sqrt($a), sqrt(1 − $a));
$d = $R*$c
echo $d;
?>
