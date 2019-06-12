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
    $COUNTN=0;       
error_reporting(E_ALL);
ini_set('display_errors', 1);

     $result = $conn->query($sql);
   $userid = $arrayJson['events'][0]['source']['userId'];
       if($userid = "U434d98c2ea737a9af2b3401a2c0abcbb")
        {
          $username = 'Benz';
        }

          if($message == "Evacuation Point")
    {        

       $query = "INSERT INTO command(iduserlink,username,command) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'Evacuation')";
       mysqli_query($conn,$query );
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "please send your location to bot and bot will send nearest evacution point to you";
        replyMsg($arrayHeader,$arrayPostData);
}
         else if($message == "People around me")
    {        

       $query = "INSERT INTO command(iduserlink,username,command) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'People')";
       mysqli_query($conn,$query );
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "please send your location to bot and bot will send nearest evacution point to you";
        replyMsg($arrayHeader,$arrayPostData);
}
         else if($message == "DiasterInformation")
    {        

        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "DiasterInformation";
        replyMsg($arrayHeader,$arrayPostData);
}

//////////////////////////////////////////////////////////////////////////////location//////////////////////////////////////////////////////////////////
          if($message == $location){
        
        $sql_command = "SELECT command FROM command where iduserlink = '".$arrayJson['events'][0]['source']['userId']."' order by date desc limit 0,1";
        $result_command = $conn->query($sql_command);
        $rowcount_command=mysqli_num_rows($result_command);

          if( $rowcount_command)>=1){
                  $row_command = $result_command->fetch_assoc();
              if($row_command["command"]=="Evacuation"){
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "text";
                $arrayPostData['messages'][0]['text'] = "E";
                replyMsg($arrayHeader,$arrayPostData);
              }
              else if($row_command["command"]=="People"){
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "text";
                $arrayPostData['messages'][0]['text'] = "P";
                replyMsg($arrayHeader,$arrayPostData);
              }else{
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "text";
                $arrayPostData['messages'][0]['text'] = "not found command";
                replyMsg($arrayHeader,$arrayPostData);
              }

          }else{
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "no command";
              replyMsg($arrayHeader,$arrayPostData);
          }


     }


//////////////////////////////////////////////////////////////////////////////location//////////////////////////////////////////////////////////////////


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
