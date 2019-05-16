<?php
    require "dbconnection.php";

    function dateDiv($t1,$t2){ // ส่งวันที่ที่ต้องการเปรียบเทียบ ในรูปแบบ มาตรฐาน 2006-03-27 21:39:12

  $t1Arr=splitTime($t1);
  $t2Arr=splitTime($t2);
 
  $Time1=mktime($t1Arr["h"], $t1Arr["m"], $t1Arr["s"], $t1Arr["M"], $t1Arr["D"], $t1Arr["Y"]);
  $Time2=mktime($t2Arr["h"], $t2Arr["m"], $t2Arr["s"], $t2Arr["M"], $t2Arr["D"], $t2Arr["Y"]);
 $TimeDiv=abs($Time2-$Time1);

  $Time["D"]=intval($TimeDiv/86400); // จำนวนวัน
  $Time["H"]=intval(($TimeDiv%86400)/3600); // จำนวน ชั่วโมง
  $Time["M"]=intval((($TimeDiv%86400)%3600)/60); // จำนวน นาที
  $Time["S"]=intval(((($TimeDiv%86400)%3600)%60)); // จำนวน วินาที
 return $Time;
}



function splitTime($time){ // เวลาในรูปแบบ มาตรฐาน 2006-03-27 21:39:12 
$timeArr["Y"]= substr($time,2,2);
$timeArr["M"]= substr($time,5,2);
$timeArr["D"]= substr($time,8,2);
$timeArr["h"]= substr($time,11,2);
$timeArr["m"]= substr($time,14,2);
 $timeArr["s"]= substr($time,17,2);
return $timeArr;
}
   
    $accessToken = "yQw5mqImEwMHcau8Hb9CXnPQaTlz11cUCGhUZL64yG1GyAyMJddLMqfjiLwlZgvKfdC2yo896ykJVwW8Xne9++3BjCqj9xsNEdeENjtWVda5UTFIw149B2ygMnCp/4Fcn/nAV1YYOX1YLNxEJkiHwwdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
$message = $arrayJson['events'][0]['message']['text'];

if($event['type'] == 'message')
if ($event instanceof LocationMessage) 
{
   $bot->replyText($event->getReplyToken(),"Latitude: {$event->getLatitude()},Longtitude: {$event->getLongitude()}");
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
