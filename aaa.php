<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
   require "dbconnection.php";
function order_array_num ($array, $key, $order = "ASC") 
{ 
  $tmp = array(); 
  foreach($array as $akey => $array2) 
  { 
    $tmp[$akey] = $array2[$key]; 
  } 
  
  if($order == "DESC") 
  {arsort($tmp);} 
  else 
  {asort($tmp);} 
  
  $tmp2 = array();  
  $i = 0;
  foreach($tmp as $key => $value) {
    $tmp2[$i] = $array[$key];
    $i++;
  }
  
  return $tmp2; 
} 
$accessToken = "yQw5mqImEwMHcau8Hb9CXnPQaTlz11cUCGhUZL64yG1GyAyMJddLMqfjiLwlZgvKfdC2yo896ykJVwW8Xne9++3BjCqj9xsNEdeENjtWVda5UTFIw149B2ygMnCp/4Fcn/nAV1YYOX1YLNxEJkiHwwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $R = 6371;
    $benz1 = array();
$locate = array();
$latu = 35.364219; //1st 7-11
$longu = 139.267804;
        $COUNTN=0;       
        $sql = "SELECT name,lati,lng,iduserlink,time,userstatus FROM user";
        $result = $conn->query($sql);
 
 if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc() ){
                  $iduser = $row["iduserlink"];
                  $lati1 = $row["lati"];
                  $lng1 = $row["lng"];
                  $userid = "U434d98c2ea737a9af2b3401a2c0abcbb";
             if($userid == $iduser)
             {
             }
             else
             {
                     $deltaLat1 = deg2rad($lati1 - $latu);
                     $deltaLong1 = deg2rad($lng1 - $longu);
                   
                    $a1 = sin($deltaLat1/2) * sin($deltaLat1/2) + cos(deg2rad($lati1)) * cos(deg2rad($latu)) * sin($deltaLong1/2) * sin($deltaLong1/2);
                    $c1 = 2 * atan2(sqrt($a1), sqrt(1-$a1));
                    $dis = $R * $c1;
                    $benz1[] = array('iduser' => $row["iduserlink"] , 'lati' => $row["lati"] , 'lng' => $row["lng"] , 'dis' => $dis) , 'name' => $row["name"] , 'time' => $row["time"] ,, 'userstatus' => $row["userstatus"];
$COUNTN++;
          }
             }
             
  $mybenz = order_array_num ($benz1, "dis", "ASC");
   
    echo '<pre>';
     print_r($mybenz);
    echo '</pre>';
      
     
}
   
?>