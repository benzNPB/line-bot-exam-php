<?php
    date_default_timezone_set('asia/tokyo');
    require "dbconnection.php";
    $accessToken = "1VaCp91ufEAAGCc001+eWKv/8GRMvzuXtS4FbnFSyHOtJtrmKHrxoimMuLClbKQ61xTsqMx4nIb9WzXXSSBTlqGHsR54L1o75ha0S6NnQM/MjoeTZmAlwT63SvRGqLpP5DgnyxubXABxTqzmzPHVCwdB04t89/1O/w1cDnyilFU=";
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    $text = $arrayJson['events'][0]['message']['text'];
    $location = $arrayJson['events'][0]['message']['location'];
    $message = $arrayJson['events'][0]['message']['text'];

    $benz1 = array();     
    $benz2 = array();     
    $COUNTN=0;   
error_reporting(E_ALL);
ini_set('display_errors', 1);
     $result = $conn->query($sql);
     $userid = $arrayJson['events'][0]['source']['userId'];
       if($arrayJson['events'][0]['source']['userId'] == "U434d98c2ea737a9af2b3401a2c0abcbb")
        {
          $username = 'Benz';
        }

       else
        {
          $username = 'Testusername';
        }

/////////////////////////////
         if($message == "Add")
    {        
       $currenttime = date("Y-m-d H:i:s");
       $query = "INSERT INTO command(iduserlink,username,Command,datime) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'add', '".$currenttime."')";
       mysqli_query($conn,$query );
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ตัวอย่าง ";
        replyMsg($arrayHeader,$arrayPostData);
    }

         else if($message == "Sell")
    {        
        $currenttime = date("Y-m-d H:i:s");
       $query = "INSERT INTO command(iduserlink,username,Command,datime) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'sell','".$currenttime."')";
       mysqli_query($conn,$query );
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "please type sell car";
        replyMsg($arrayHeader,$arrayPostData);
    }

         else if($message == "Check")
    {        
        $currenttime = date("Y-m-d H:i:s");
       $query = "INSERT INTO command(iduserlink,username,Command,datime) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'check','".$currenttime."')";
       mysqli_query($conn,$query );
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "please type check car";
        replyMsg($arrayHeader,$arrayPostData);
    }    
        else if($row_command["Command"]=="add"){
        $query = "INSERT INTO locktech(brand,year,gear,num) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'sell','".$currenttime."')";
       mysqli_query($conn,$query );
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = ".$message.";
        replyMsg($arrayHeader,$arrayPostData);
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
