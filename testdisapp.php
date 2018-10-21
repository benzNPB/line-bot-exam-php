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
          $R = 6371;

  $lat1 = 35.364219; //1st 7-11
  $long1 = 139.267804;
         $deltaLat = deg2rad($row["lati"] - $lat);
        $deltaLong = deg2rad($row["longt"] - $long);
         $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($row["lati"])) * sin($deltaLong/2) * sin($deltaLong/2);
         $c = 2 * atan2(sqrt($a), sqrt(1-$a));
         $dis1 = $R * $c;
  $lat2 = 35.366817; //2nd lawson
  $long2 = 139.272703;
         $deltaLat = deg2rad($row["lati"] - $lat);
        $deltaLong = deg2rad($row["longt"] - $long);
         $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat2)) * cos(deg2rad($row["lati"])) * sin($deltaLong/2) * sin($deltaLong/2);
         $c = 2 * atan2(sqrt($a), sqrt(1-$a));
         $dis2 = $R * $c;
  $lat3 = 35.372509; //3rd Family
  $long3 = 139.271988;
         $deltaLat = deg2rad($row["lati"] - $lat);
        $deltaLong = deg2rad($row["longt"] - $long);
         $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat3)) * cos(deg2rad($row["lati"])) * sin($deltaLong/2) * sin($deltaLong/2);
         $c = 2 * atan2(sqrt($a), sqrt(1-$a));
         $dis3 = $R * $c;
  $lat4 = 35.366817; //4th lawson
  $long4 = 139.272703;
         $deltaLat = deg2rad($row["lati"] - $lat);
        $deltaLong = deg2rad($row["longt"] - $long);
         $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat4)) * cos(deg2rad($row["lati"])) * sin($deltaLong/2) * sin($deltaLong/2);
         $c = 2 * atan2(sqrt($a), sqrt(1-$a));
         $dis4 = $R * $c;
  $lat5 = 35.372509; //5th Daily
  $long5 = 139.271988;
         $deltaLat = deg2rad($row["lati"] - $lat);
        $deltaLong = deg2rad($row["longt"] - $long);
         $a = sin($deltaLat/2) * sin($deltaLat/2) + cos(deg2rad($lat5)) * cos(deg2rad($row["lati"])) * sin($deltaLong/2) * sin($deltaLong/2);
         $c = 2 * atan2(sqrt($a), sqrt(1-$a));
         $dis5 = $R * $c;

  min(dis1,dis2,dis3,dis4,dis5)
  } 

    switch
 ($dis) {
  case
 "dis1":
  $lat = 35.364219; //1st 7-11
  $long = 139.267804;
case
 "dis2":
  $lat = 35.366817; //2nd lawson
  $long = 139.272703;
  case
 "dis3":
  $lat = 35.372509; //3rd Family
  $long = 139.271988;
case
 "dis4":
  $lat = 35.366817; //4th lawson
  $long = 139.272703;
  case
 "dis5":
  $lat = 35.372509; //5th Daily
  $long = 139.271988;
}

           $arrayPostData['messages'][0]['type'] = "location";
           $arrayPostData['messages'][0]['title'] = "location from database";
           $arrayPostData['messages'][0]['address'] =  $lat.",".$long;
           $arrayPostData['messages'][0]['latitude'] =  $lat;
           $arrayPostData['messages'][0]['longitude'] =$long;
}else{
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = "error";
        }
        replyMsg($arrayHeader,$arrayPostData);
    }

    else
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "please input 'location' and bot will show location or 'earthquake' bot will show earthquake location";
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
 
        
   exit;
?>
