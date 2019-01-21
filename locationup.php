<?php
    require "dbconnection.php";
   
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
        $arrayPostData['messages'][0]['text'] = "$xmlt.",".$xml[0].",".$xml[1]";
        $arrayPostData['messages'][1]['type'] = "location";
        $arrayPostData['messages'][1]['title'] = "test";
        $arrayPostData['messages'][1]['address'] =  $xml[3].",".$xml[6];
        $arrayPostData['messages'][1]['latitude'] = $xml[3];
        $arrayPostData['messages'][1]['longitude'] = $xml[6];
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
