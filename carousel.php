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

        $columns  =  [];  // Add array of 5 carousel type columns 
   /*     foreach  ( $lists  as  $list )  { 
                   // Create a button to give to carousel 
        $action  =  new  UriTemplateActionBuilder ( "Click and try " ,  / * Summary URL * /  ); 
        // Create carousel column 
        $column  =  new  CarouselColumnTemplateBuilder ( "Title (up to 40 characters)" ,  "Additional sentence" , "https://static.wixstatic.com/media/b46608_bd800c813dad44f69c121da3af790314.jpg/v1/fill/w_555,h_370,al_c,q_80,usm_0.66_1.00_0.01/b46608_bd800c813dad44f69c121da3af790314.jpg" ,  [ $action ]); 
        $columns []  =  $column ; 
                                       } 
           // Create a carousel by combining the array of columns
        $carousel  =  new  CarouselTemplateBuilder ( $columns ); 
           // Make a message by adding a carousel 
        $carousel_message  =  new TemplateMessageBuilder ( "Message Title" ,  $ carousel );
        $arrayPostData['messages'][0]['columns'] = $carousel_message;*/
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
