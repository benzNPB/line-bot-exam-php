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
                
      if($message == $location)
    {
      $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "your location";
        $arrayPostData['messages'][0]['address'] =  $arrayJson['events'][0]['message']['latitude'].",".$arrayJson['events'][0]['message']['longitude'];
        $arrayPostData['messages'][0]['latitude'] = $arrayJson['events'][0]['message']['latitude'];
        $arrayPostData['messages'][0]['longitude'] = $arrayJson['events'][0]['message']['longitude'];
        replyMsg($arrayHeader,$arrayPostData);          
    }

   else if($message == $text)
    {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "carousel";

   $actionBuilder = array(
        new MessageTemplateActionBuilder(
            'Message Template',// ข้อความแสดงในปุ่ม
            'This is Text' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
        ),
        new UriTemplateActionBuilder(
            'Uri Template', // ข้อความแสดงในปุ่ม
            'https://www.ninenik.com'
        ),
        new PostbackTemplateActionBuilder(
            'Postback', // ข้อความแสดงในปุ่ม
            http_build_query(array(
                'action'=>'buy',
 
                'item'=>100
            )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
            'Postback Text'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
        ),      
    );
    $replyData = new TemplateMessageBuilder('Carousel',
        new CarouselTemplateBuilder(
            array(
                new CarouselColumnTemplateBuilder(
                    'Title Carousel',
                    'Description Carousel',
                    'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                    $actionBuilder
                ),
                new CarouselColumnTemplateBuilder(
                    'Title Carousel',
                    'Description Carousel',
                    'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                    $actionBuilder
                ),
                new CarouselColumnTemplateBuilder(
                    'Title Carousel',
                    'Description Carousel',
                    'https://www.mywebsite.com/imgsrc/photos/f/sampleimage/700',
                    $actionBuilder
                ),                                          
            )
        )
    );
    break;  
          $arrayPostData['messages'][0]['columns'] = $replyData;
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
