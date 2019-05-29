
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
	{arsort($tmp , SORT_NUMERIC );} 
	else 
	{asort($tmp , SORT_NUMERIC );} 

	$tmp2 = array();        
	foreach($tmp as $key => $value) 
	{ 
		$tmp2[$key] = $array[$key]; 
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
  $latu = 10.000000;
   $longu = 111.111111;
        $COUNTN=0;       
        $sql = "SELECT no,name,lati,lng FROM contest order by no desc limit 0,5";
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
	 
	 /////////////////////////// use
	 

	 
	 for($i=0;$i<=3;$i++){
		 print_r($mybenz);
    echo "<br><br>";
		 echo $mybenz[$i]["name"];
		  echo "<br><br>";
		  
		 
	;
	 }

}
   
?>

