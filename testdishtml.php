<?php
 
//$latu = 35.368347;//users location (秦野市立大根中学校)
//$longu = 139.268366;
$latu = 35.371491;//users location (弘済学園)
$longu = 139.259814;
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
for (i=1;i<=5;i++)
echo $lat(i) .",". $long(i);   
?>
