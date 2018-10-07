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
    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    $sql = "SELECT iddb, lati, longt, mag FROM db order by iddb desc limit 0,1";
    $result = $conn->query($sql);

      $row = $result->fetch_assoc();
        if ($row["mag"]> "30") {
           $arrayPostData['messages'][0]['type'] = "location";
           $arrayPostData['messages'][0]['title'] = "location from database";
           $arrayPostData['messages'][0]['address'] = $row["lati"].",".$row["longt"];
           $arrayPostData['messages'][0]['latitude'] = $row["lati"];
           $arrayPostData['messages'][0]['longitude'] = $row["longt"];
        }else{
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = "error";
        }
        replyMsg($arrayHeader,$arrayPostData);
    

        else if ($message == "earthquake") {
          $url = "http://www.earthquake.tmd.go.th/feed/rss_inside.xml";
          $xml = simplexml_load_file($url);
          $o = strpos($xml->channel->item[0]->title,"(" );
          $s = strpos($xml->channel->item[0]->title,"," );
          $c = strpos($xml->channel->item[0]->title,")" );
          $la = substr($xml->channel->item[0]->title,$o+1 ,$s-$o-1);
          $lo = substr($xml->channel->item[0]->title,$s+1 ,$c-$s-1);
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "earthquake";
        $arrayPostData['messages'][0]['address'] =  $la.",".$lo;
        $arrayPostData['messages'][0]['latitude'] = $la;
        $arrayPostData['messages'][0]['longitude'] = $lo;
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
