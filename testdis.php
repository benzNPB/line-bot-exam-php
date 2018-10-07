<?php

	$lat1 = 35.372871;
	$long1 = 139.270905;
	$lat2 = 35.360845;
	$long2 = 139.272493;
	$R = 6371;
    
    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLong = deg2rad($long2 - $long1);

    $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLong/2) * sin($deltaLong/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));

    $distance = $R * $c;
   echo $distance;    // in km
?>
