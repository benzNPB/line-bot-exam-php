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
       $currenttime = date("d-M-Y H:i:s");
       $query = "INSERT INTO command(iduserlink,username,Command,datime) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'Evacuation', '".$currenttime."')";
       mysqli_query($conn,$query );
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "please send your location to bot and bot will send nearest evacution point to you";
        replyMsg($arrayHeader,$arrayPostData);
    }
         else if($message == "People around me")
    {        
        $currenttime = date("d-M-Y H:i:s");
       $query = "INSERT INTO command(iduserlink,username,Command,datime) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'People','".$currenttime."')";
       mysqli_query($conn,$query );
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "please send your location to bot and bot will send people's location around you";
        replyMsg($arrayHeader,$arrayPostData);
    }
         else if($message == "DisasterInformationN")
    {        
       $currenttime = date("d-M-Y H:i:s");
       $query = "INSERT INTO command(iduserlink,username,Command,datime) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'Location','".$currenttime."')";
       mysqli_query($conn,$query );
       $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
       $arrayPostData['messages'][0]['type'] = "text";
       $arrayPostData['messages'][0]['text'] = "please send your location to bot and bot will send disaster information in your location";
       replyMsg($arrayHeader,$arrayPostData);
    }
         else if($message == "DisasterInformation")
    {        
        $currenttime = date("d-M-Y H:i:s");
        $query = "INSERT INTO command(iduserlink,username,Command,datime) VALUES ('".$arrayJson['events'][0]['source']['userId']."' , '".$username."', 'Location','".$currenttime."')";
        mysqli_query($conn,$query );
        $url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
        $xmll = simplexml_load_file($url);
        $xmld = $xmll->channel->item[0]->description;
        $xmlt = $xmll->channel->item[0]->title;
        $xmled = (explode(" ",$xmld));
        $xmlet = (explode(" ",$xmlt));
        $xmld1 = $xmll->channel->item[1]->description;
        $xmlt1 = $xmll->channel->item[1]->title;
        $xmled1 = (explode(" ",$xmld1));
        $xmlet1 = (explode(" ",$xmlt1));
        $xmld2 = $xmll->channel->item[2]->description;
        $xmlt2 = $xmll->channel->item[2]->title;
        $xmled2 = (explode(" ",$xmld2));
        $xmlet2 = (explode(" ",$xmlt2));
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "This is the 3 latest an earthquake point";
        $arrayPostData['messages'][1]['type'] = "location";
        $arrayPostData['messages'][1]['title'] = $xmlet[0]." ".$xmlet[1]."  ".$xmlet[2]." ".$xmlet[3]." ".$xmlet[4]." ".$xmlet[5]." ".$xmlet[6];
        $arrayPostData['messages'][1]['address'] = $xmled[3].",".$xmled[6];
        $arrayPostData['messages'][1]['latitude'] = $xmled[3];
        $arrayPostData['messages'][1]['longitude'] = $xmled[6];
        $arrayPostData['messages'][2]['type'] = "location";
        $arrayPostData['messages'][2]['title'] = $xmlet1[0]." ".$xmlet1[1]."  ".$xmlet1[2]." ".$xmlet1[3]." ".$xmlet1[4]." ".$xmlet1[5]." ".$xmlet1[6];
        $arrayPostData['messages'][2]['address'] = $xmled1[3].",".$xmled1[6];
        $arrayPostData['messages'][2]['latitude'] = $xmled1[3];
        $arrayPostData['messages'][2]['longitude'] = $xmled1[6];
        $arrayPostData['messages'][3]['type'] = "location";
        $arrayPostData['messages'][3]['title'] = $xmlet2[0]." ".$xmlet2[1]."  ".$xmlet2[2]." ".$xmlet2[3]." ".$xmlet2[4]." ".$xmlet2[5]." ".$xmlet2[6];
        $arrayPostData['messages'][3]['address'] = $xmled2[3].",".$xmled2[6];
        $arrayPostData['messages'][3]['latitude'] = $xmled2[3];
        $arrayPostData['messages'][3]['longitude'] = $xmled2[6];
        $arrayPostData['messages'][4]['type'] = "text";
        $arrayPostData['messages'][4]['text'] = "If you want to know the latest disaster information in your location please send your location to bot";
        replyMsg($arrayHeader,$arrayPostData);
}
          if($message == "Userid")
    {        
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $arrayJson['events'][0]['source']['userId'];
        replyMsg($arrayHeader,$arrayPostData);
}
////// ////////////////////////////////////////////////////////////////////////location//////////////////////////////////////////////////////////////////
          if($message == $location){
       $latu = $arrayJson['events'][0]['message']['latitude'];//users location 
       $longu = $arrayJson['events'][0]['message']['longitude']; 
       $sql_command = "SELECT Command FROM command where iduserlink = '".$arrayJson['events'][0]['source']['userId']."' order by datime desc limit 0,1";
       $result_command = mysqli_query($conn,$sql_command );
       $query_user = "INSERT INTO user(name,lati,lng,iduserlink) VALUES ('benz', '".$latu."', '".$longu."','".$arrayJson['events'][0]['source']['userId']."' )";
       mysqli_query($conn,$query_user );
           if($result_command){
       $row_command = $result_command->fetch_assoc();

            //////////////////////////////////EVACUATION////////////////////////////////////////
         if($row_command["Command"]=="Evacuation"){
       $sql = "SELECT no,name,lati,lng FROM contest";
       $result = $conn->query($sql);
 if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc() ){
                  $lati1 = $row["lati"];
                  $lng1 = $row["lng"];
                    $deltaLat1 = deg2rad($lati1 - $latu);
                    $deltaLong1 = deg2rad($lng1 - $longu);
                   
                    $a1 = sin($deltaLat1/2) * sin($deltaLat1/2) + cos(deg2rad($lati1)) * cos(deg2rad($latu)) * sin($deltaLong1/2) * sin($deltaLong1/2);
                    $c1 = 2 * atan2(sqrt($a1), sqrt(1-$a1));
                    $dis = $R * $c1;
                    $benz1[] = array('name' => $row["name"] , 'lati' => $row["lati"] , 'lng' => $row["lng"] , 'dis' => $dis);
 
$COUNTN++;
          }
  $mybenz = order_array_num ($benz1, "dis", "ASC");
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "Here is your nearest Evacuation point";
        $arrayPostData['messages'][1]['type'] = "location";
        $arrayPostData['messages'][1]['title'] = $mybenz[0]["name"];
        $arrayPostData['messages'][1]['address'] =   $mybenz[0]["lati"].",".$mybenz[0]["lng"];
        $arrayPostData['messages'][1]['latitude'] =  $mybenz[0]["lati"];
        $arrayPostData['messages'][1]['longitude'] =  $mybenz[0]["lng"];
        $arrayPostData['messages'][2]['type'] = "location";
        $arrayPostData['messages'][2]['title'] = $mybenz[1]["name"];
        $arrayPostData['messages'][2]['address'] =   $mybenz[1]["lati"].",".$mybenz[1]["lng"];
        $arrayPostData['messages'][2]['latitude'] =  $mybenz[1]["lati"];
        $arrayPostData['messages'][2]['longitude'] =  $mybenz[1]["lng"];
        $arrayPostData['messages'][3]['type'] = "location";
        $arrayPostData['messages'][3]['title'] = $mybenz[2]["name"].",".$mybenz[2]["dis"];
        $arrayPostData['messages'][3]['address'] =   $mybenz[2]["lati"].",".$mybenz[2]["lng"];
        $arrayPostData['messages'][3]['latitude'] =  $mybenz[2]["lati"];
        $arrayPostData['messages'][3]['longitude'] =  $mybenz[2]["lng"];
        $link[1] = "https://www.google.com/search?hl=th&ei=mI0IXf2aHPmVr7wP5-CroAo&q=".$mybenz[3]["lati"]."%2C".$mybenz[3]["lng"];
        $link[2] = "https://www.google.com/search?hl=th&ei=mI0IXf2aHPmVr7wP5-CroAo&q=".$mybenz[4]["lati"]."%2C".$mybenz[4]["lng"];
        $arrayPostData['messages'][4]['type'] = "text";
        $arrayPostData['messages'][4]['text'] = $link[1] ."     ".$link[2];
        replyMsg($arrayHeader,$arrayPostData);
}
              }
            ///////////////////////////////////////////////////////////////////////////////
                        //////////////////////////////////EVACUATION LOCATION////////////////////////////////////////
         if($row_command["Command"]=="Location"){
        $address = $arrayJson['events'][0]['message']['address'];

        $tokens = explode(",", $address);  

              if($tokens[2] == ' Hiratsuka-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtHQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                 }
              else if($tokens[1] == ' Hadano-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtgQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Yokosuka-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtCQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Kamakura-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtMQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[2] == ' Fujisawa-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtRQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Odawara-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsAQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Zushi-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtbQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Miura-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Bt8QAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Atsugi-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtlQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Yamato-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtqQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Isehara-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrRQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Zama-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtvQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Minamiashigara-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Bu0QAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Ayase-shi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Bu5QAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Hayama-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtNQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Samukawa-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BuAQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Ōiso-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BswQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Ninomiya-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BuFQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Nakai-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Bv8QAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Ōi-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BuKQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Matsuda-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BuPQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Yamakita-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BuUQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Kaisei-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrHQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Hakone-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BuZQAV";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Manazuru-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Bu1QAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Yugawara-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BueQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Aikawa-machi'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BujQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Kiyokawa-mura'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BuoQAF";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Tsurumi-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Br1QAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Kanagawa-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Br6QAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Nishi-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrBQAV&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Naka-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Br2QAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Minami-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrGQAV&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Hodogaya-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrLQAV&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Isogo-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrQQAV&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Kanazawa-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrVQAV&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Kohoku-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BraQAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Totsuka-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BqTQAV&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Konan-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrfQAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Asahi-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrkQAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Midori-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrpQAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Seya-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BruQAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Sakae-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BrzQAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Izumi-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Bs4QAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Aoba-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5Bs9QAF&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Tsuzuki-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsEQAV&shibucode=S01";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Kawasaki-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsJQAV&shibucode=S02";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Saiwai-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsOQAV&shibucode=S02";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Nakahara-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsTQAV&shibucode=S02";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Takatsu-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsYQAV&shibucode=S02";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Tama-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsdQAF&shibucode=S02";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Miyamae-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsiQAF&shibucode=S02";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
              else if($tokens[1] == ' Aso-ku'){
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BsnQAF&shibucode=S02";
              replyMsg($arrayHeader,$arrayPostData);        
                                                  }
         else {
                $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
                $arrayPostData['messages'][0]['type'] = "text";
                $arrayPostData['messages'][0]['text'] = $tokens[0].",   ,".$tokens[1].",   ,".$tokens[2];
                replyMsg($arrayHeader,$arrayPostData);    
         }
       }
            ///////////////////////////////////////////////////////////////////////////////
              else if($row_command["Command"]=="People"){
        $sql = "SELECT name,lati,lng,iduserlink FROM user WHERE $row["iduserlink"] != $arrayJson['events'][0]['source']['userId']";
        $result = $conn->query($sql);
 if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc() ){
                  $lati1 = $row["lati"];
                  $lng1 = $row["lng"];

                     $deltaLat1 = deg2rad($lati1 - $latu);
                     $deltaLong1 = deg2rad($lng1 - $longu);
                   
                    $a1 = sin($deltaLat1/2) * sin($deltaLat1/2) + cos(deg2rad($lati1)) * cos(deg2rad($latu)) * sin($deltaLong1/2) * sin($deltaLong1/2);
                    $c1 = 2 * atan2(sqrt($a1), sqrt(1-$a1));
                    $dis = $R * $c1;
                    $benz1[] = array('name' => $row["name"] , 'lati' => $row["lati"] , 'lng' => $row["lng"] , 'dis' => $dis);
 
$COUNTN++;
          }
        $mybenz = order_array_num ($benz1, "dis", "ASC");
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "Here is people around you in 1 km.";
        $arrayPostData['messages'][1]['type'] = "location";
        $arrayPostData['messages'][1]['title'] = $mybenz[0]["name"];
        $arrayPostData['messages'][1]['address'] =   $mybenz[0]["lati"].",".$mybenz[0]["lng"];
        $arrayPostData['messages'][1]['latitude'] =  $mybenz[0]["lati"];
        $arrayPostData['messages'][1]['longitude'] =  $mybenz[0]["lng"];
        $arrayPostData['messages'][2]['type'] = "location";
        $arrayPostData['messages'][2]['title'] = $mybenz[1]["name"];
        $arrayPostData['messages'][2]['address'] =   $mybenz[1]["lati"].",".$mybenz[1]["lng"];
        $arrayPostData['messages'][2]['latitude'] =  $mybenz[1]["lati"];
        $arrayPostData['messages'][2]['longitude'] =  $mybenz[1]["lng"];
        $arrayPostData['messages'][3]['type'] = "location";
        $arrayPostData['messages'][3]['title'] = $mybenz[2]["name"];
        $arrayPostData['messages'][3]['address'] =   $mybenz[2]["lati"].",".$mybenz[2]["lng"];
        $arrayPostData['messages'][3]['latitude'] =  $mybenz[2]["lati"];
        $arrayPostData['messages'][3]['longitude'] =  $mybenz[2]["lng"];
        $link1 = "https://www.google.com/search?hl=th&ei=mI0IXf2aHPmVr7wP5-CroAo&q=".$mybenz[3]["lati"]."%2C".$mybenz[3]["lng"];
        $link2 = "https://www.google.com/search?hl=th&ei=mI0IXf2aHPmVr7wP5-CroAo&q=".$mybenz[4]["lati"]."%2C".$mybenz[4]["lng"];
        $link3 = "https://www.google.com/search?hl=th&ei=mI0IXf2aHPmVr7wP5-CroAo&q=".$mybenz[5]["lati"]."%2C".$mybenz[5]["lng"];
        $link4 = "https://www.google.com/search?hl=th&ei=mI0IXf2aHPmVr7wP5-CroAo&q=".$mybenz[6]["lati"]."%2C".$mybenz[6]["lng"];
        $link5 = "https://www.google.com/search?hl=th&ei=mI0IXf2aHPmVr7wP5-CroAo&q=".$mybenz[7]["lati"]."%2C".$mybenz[7]["lng"];
        $link6 = "https://www.google.com/search?hl=th&ei=mI0IXf2aHPmVr7wP5-CroAo&q=".$mybenz[8]["lati"]."%2C".$mybenz[8]["lng"];
         $arrayPostData['messages'][4]['type'] = "text";
         $arrayPostData['messages'][4]['text'] = "4)  ".$link1."  5)".$link2."  6)".$link3."  7)".$link4."  8)".$link5."  9)".$link6;
        replyMsg($arrayHeader,$arrayPostData);
}
              }

          }else{
              $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
              $arrayPostData['messages'][0]['type'] = "text";
              $arrayPostData['messages'][0]['text'] = "no command".$sql_command;
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
