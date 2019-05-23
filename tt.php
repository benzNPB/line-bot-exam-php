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
     if($message == "location")

    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $sql = "SELECT iddb, lati, longt FROM db order by iddb desc limit 0,1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
           $arrayPostData['messages'][0]['type'] = "location";
           $arrayPostData['messages'][0]['title'] = "location from database";
           $arrayPostData['messages'][0]['address'] =   $row["lati"].",".$row["longt"];
           $arrayPostData['messages'][0]['latitude'] = $row["lati"];
           $arrayPostData['messages'][0]['longitude'] =$row["longt"];
        }else{
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = "error";
        }
        replyMsg($arrayHeader,$arrayPostData);
    }
        else if ($message == "earthquake") {
        $url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
        $xml1 = simplexml_load_file($url);
        $xml2 = $xml1->channel->item[0]->description;
        $xmlt = $xml1->channel->item[0]->title;
        $xml = (explode(" ",$xml2));
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "$xmlt";
        $arrayPostData['messages'][1]['type'] = "location";
        $arrayPostData['messages'][1]['title'] = "Earthquake is happened";
        $arrayPostData['messages'][1]['address'] =  $xml[3].",".$xml[6];
        $arrayPostData['messages'][1]['latitude'] = $xml[3];
        $arrayPostData['messages'][1]['longitude'] = $xml[6];
        replyMsg($arrayHeader,$arrayPostData);
    }
        else if ($message == "check") {
        $url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
        $xml1 = simplexml_load_file($url);
        $xml2 = $xml1->channel->item[0]->description;
        $xmlt = $xml1->channel->item[0]->title;
        $xml = (explode(" ",$xml2));
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        

//check time
//$t1="2006-03-27 21:20:00";
        $t1=$xml[0]." ".$xml[1];
        $t2=date("Y-m-d H:i:s");
        $time=dateDiv($t1,$t2);


        if($time["D"]==0&&$time["H"]==0&&$time["M"]>0&&$time["M"]<5){
          //check location
            
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "$xmlt";
            $arrayPostData['messages'][1]['type'] = "location";
            $arrayPostData['messages'][1]['title'] = "Earthquake is happened";
            $arrayPostData['messages'][1]['address'] =  $xml[3].",".$xml[6];
            $arrayPostData['messages'][1]['latitude'] = $xml[3];
            $arrayPostData['messages'][1]['longitude'] = $xml[6];
          replyMsg($arrayHeader,$arrayPostData);
        }else{
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "Dont have earthquake around here";
           replyMsg($arrayHeader,$arrayPostData);
        }

        
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
