<?php
 
	$lat1 = 35.372871;
	$long1 = 139.270905;
	$lat2 = 35.360845;
	$long2 = 139.272493;
	$lat3 = 35.368761;
	$long3 = 139.268089;
	$R = 6371;
    
    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLong = deg2rad($long2 - $long1);

    $deltaLat2 = deg2rad($lat2 - $lat3);
    $deltaLong2 = deg2rad($long2 - $long3);

    $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLong/2) * sin($deltaLong/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $distance = $R * $c;

    $a2 = sin($deltaLat2/2) * sin($deltaLat2/2) + cos(deg2rad($lat3)) * cos(deg2rad($lat2)) * sin($deltaLong2/2) * sin($deltaLong2/2);
    $c2 = 2 * atan2(sqrt($a2), sqrt(1-$a2));
    $distance2 = $R * $c2;

   echo "distance 1 is "
   echo $distance;    // in km
   echo "km"
	   
   echo "distance 2 is "
   echo $distance2;    // in km
   echo "km"
?>
