<?php
 
//$latu = 35.368347;//users location (秦野市立大根中学校)
//$longu = 139.268366;
$latu = 35.371558;//users location (弘済学園)
$longu = 139.259752;
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

$dis = min ($dis1,$dis2,$dis3,$dis4,$dis5);
if ($dis == $dis1) {
        echo "1st 7-11". "<br>";
        echo "distance is " . $dis1. "<br>";
        echo $lat1 .",". $long1;
}
else if ($dis == $dis2) {
        echo "2nd lawson". "<br>";
        echo "distance is " . $dis2. "<br>";
        echo $lat2 .",". $long2;     
}
else if ($dis == $dis3) {
        echo"3rd Family". "<br>";
        echo "distance is " . $dis3. "<br>";
        echo $lat3 .",". $long3;   
}
else if ($dis == $dis4) {
        echo "4th lawson". "<br>";
        echo "distance is " . $dis4. "<br>";
        echo $lat4 .",". $long4;   
}
else if ($dis == $dis5) {
        echo "5th Daily". "<br>" ;
        echo "distance is " . $dis5. "<br>";
        echo $lat5 .",". $long5;   
}

?>
