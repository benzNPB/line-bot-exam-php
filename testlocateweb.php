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
$latid = 35.38335641; ////////////////////////// Disaster's location364341
$lngd = 139.4997592;  ////////////////////////// Disaster's location
        $COUNTN=0;       
       $sql = "SELECT no,name,lati,lng FROM contest order by time desc limit 0,5";
        $result = $conn->query($sql);
          
 if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc() ){
                  $lati1 = $row["lati"];
                  $lng1 = $row["lng"];
                     $deltaLat1 = deg2rad($lati1 - $latu);
                     $deltaLong1 = deg2rad($lng1 - $longu);
                   
                    $a1 = sin($deltaLat1/2) * sin($deltaLat1/2) + cos(deg2rad($lati1)) * cos(deg2rad($latu)) * sin($deltaLong1/2) * sin($deltaLong1/2);
                    $c1 = 2 * atan2(sqrt($a1), sqrt(1-$a1));
                    $dis = $R * $c1;
                    $benz1[] = array('name' => $row["name"] , 'lati' => $row["lati"] , 'lng' => $row["lng"] , 'dis' => $dis);

                    $deltaLat1d = deg2rad($lati1 - $latid);
                    $deltaLong1d = deg2rad($lng1 - $lngd);
                  
                    $a1d = sin($deltaLat1d/2) * sin($deltaLat1d/2) + cos(deg2rad($lati1)) * cos(deg2rad($latid)) * sin($deltaLong1d/2) * sin($deltaLong1d/2);
                    $c1d = 2 * atan2(sqrt($a1d), sqrt(1-$a1d));
                    $disd = $R * $c1d;
                    if($disd < 10){
                    $benz2[] = array('name' => $row["name"] , 'lati' => $row["lati"] , 'lng' => $row["lng"] , 'dis' => $disd);
                    }


                    // $benz1[$COUNTN][0] = $row["name"];
                    //$benz1[$COUNTN][1] = $row["lati"];
                   // $benz1[$COUNTN][2] = $row["lng"];
                     //$benz1[$COUNTN][3] = $dis;
$COUNTN++;
          }
   // foreach ($benz1 as $key => $row) {
      // $dis[$key]  = $row['dis']; 
   // }
//$locate = array_multisort( $dis, SORT_ASC, $benz1);
//$locate = array_multisort()
    //print_r($benz1);
    //echo "<br><br>";
    //print_r(order_array_num ($benz1, "dis", "ASC"));
	$mybenz = order_array_num ($benz1, "dis", "ASC");
  $mybenz1 = order_array_num ($benz2, "dis", "ASC");

	 /////////////////////////// use
	 
	 	echo '<pre>';
		 print_r($mybenz);
	 	echo '</pre>';

	   echo '<pre>';
     print_r($mybenz1);
    echo '</pre>';	  

    echo '<pre>';
     print_r($mybenz[0]['name']);
    echo '</pre>';

    echo '<pre>';
     print_r($mybenz1[0]['name']);
    echo '</pre>';

}
   
?>