<?php
    require "dbconnection.php";
   
    $accessToken = "yQw5mqImEwMHcau8Hb9CXnPQaTlz11cUCGhUZL64yG1GyAyMJddLMqfjiLwlZgvKfdC2yo896ykJVwW8Xne9++3BjCqj9xsNEdeENjtWVda5UTFIw149B2ygMnCp/4Fcn/nAV1YYOX1YLNxEJkiHwwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    //รับข้อความจากผู้ใช้
$message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
      if($message == "location")
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $sql = "SELECT iddb, lati, longt FROM db order by iddb desc limit 0,1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $latu = 35.361010;//users location 
          $longu = 139.280074;
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


for ($i = 1; $x <= 5; $i++) {
  $deltaLat$i = deg2rad($lat$i - $latu);
  $deltaLong$i = deg2rad($long$i - $longu);
  $a$i = sin($deltaLat$i/2) * sin($deltaLat$i/2) + cos(deg2rad($lat$i)) * cos(deg2rad($latu)) * sin($deltaLong$i/2) * sin($deltaLong$i/2);
  $c$i = 2 * atan2(sqrt($a$i), sqrt(1-$a$i));
  $dis$i = $R * $c$i;
  echo $dis$i;
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
 
        
   exit;
?>