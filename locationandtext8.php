<?php
    require "dbconnection.php";

    $accessToken = "yQw5mqImEwMHcau8Hb9CXnPQaTlz11cUCGhUZL64yG1GyAyMJddLMqfjiLwlZgvKfdC2yo896ykJVwW8Xne9++3BjCqj9xsNEdeENjtWVda5UTFIw149B2ygMnCp/4Fcn/nAV1YYOX1YLNxEJkiHwwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    $text = $arrayJson['events'][0]['message']['text'];
    $location = $arrayJson['events'][0]['message']['location'];
    $message = $arrayJson['events'][0]['message']['text'];
         
$R = 6371;
$benz1 = array();
$locate = array();
        $COUNTN=0;       
        $sql = "SELECT name,lati,lng,iduserlink FROM user ";
        $result = $conn->query($sql);
          if($message == $location)
    {
   $latu = $arrayJson['events'][0]['message']['latitude'];//users location 
   $longu = $arrayJson['events'][0]['message']['longitude'];
   $userid = $arrayJson['events'][0]['source']['userId'];
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
 
$COUNTN++;
          }
  $mybenz = order_array_num ($benz1, "dis", "ASC");
   
///////////////////////////////
$x = 0;
while($mybenz[$x]["dis"] < 1) {

        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][$x]['type'] = "location";
        $arrayPostData['messages'][$x]['title'] = $mybenz[$x]["name"];
        $arrayPostData['messages'][$x]['address'] =   $mybenz[$x]["lati"].",".$mybenz[$x]["lng"];
        $arrayPostData['messages'][$x]['latitude'] =  $mybenz[$x]["lati"];
        $arrayPostData['messages'][$x]['longitude'] =  $mybenz[$x]["lng"];
    $x++;
        $arrayPostData['messages'][$x]['type'] = "location";
        $arrayPostData['messages'][$x]['title'] = $mybenz[$x]["name"];
        $arrayPostData['messages'][$x]['address'] =   $mybenz[$x]["lati"].",".$mybenz[$x]["lng"];
        $arrayPostData['messages'][$x]['latitude'] =  $mybenz[$x]["lati"];
        $arrayPostData['messages'][$x]['longitude'] =  $mybenz[$x]["lng"];
    $x++;
        $arrayPostData['messages'][$x]['type'] = "location";
        $arrayPostData['messages'][$x]['title'] = $mybenz[$x]["name"];
        $arrayPostData['messages'][$x]['address'] =   $mybenz[$x]["lati"].",".$mybenz[$x]["lng"];
        $arrayPostData['messages'][$x]['latitude'] =  $mybenz[$x]["lati"];
        $arrayPostData['messages'][$x]['longitude'] =  $mybenz[$x]["lng"];
     $x++;
        $arrayPostData['messages'][$x]['type'] = "location";
        $arrayPostData['messages'][$x]['title'] = $mybenz[$x]["name"];
        $arrayPostData['messages'][$x]['address'] =   $mybenz[$x]["lati"].",".$mybenz[$x]["lng"];
        $arrayPostData['messages'][$x]['latitude'] =  $mybenz[$x]["lati"];
        $arrayPostData['messages'][$x]['longitude'] =  $mybenz[$x]["lng"];
    $x++;
        $arrayPostData['messages'][$x]['type'] = "location";
        $arrayPostData['messages'][$x]['title'] = $mybenz[$x]["name"];
        $arrayPostData['messages'][$x]['address'] =   $mybenz[$x]["lati"].",".$mybenz[$x]["lng"];
        $arrayPostData['messages'][$x]['latitude'] =  $mybenz[$x]["lati"];
        $arrayPostData['messages'][$x]['longitude'] =  $mybenz[$x]["lng"];
    $x++;
       $arrayPostData['messages'][$x]['type'] = "text";
        $arrayPostData['messages'][$x]['text'] = $arrayJson['events'][0]['source']['userId'];
        replyMsg($arrayHeader,$arrayPostData);
       $query = "INSERT INTO user(name,lati,lng,iduserlink) VALUES ('benz', '".$latu."', '".$longu."','".$arrayJson['events'][0]['source']['userId']."' )";
       mysqli_query($conn,$query );
     
        $x++;
}
     
}
       
}
   else if($message == $text)
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $arrayJson['events'][0]['source']['userId'];
        replyMsg($arrayHeader,$arrayPostData);
    }
         function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
    
     function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
        function getuserid($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/profile/{userId}";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
 
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
  $i = 0;
  foreach($tmp as $key => $value) {
    $tmp2[$i] = $array[$key];
    $i++;
  }
  return $tmp2; 
}      
   exit;
?>
