<?php
           $url = "http://www.gdacs.org/xml/rss.xml";
           $xml = simplexml_load_file($url);

           $xmlt = $xml->channel->item[0]->description;


foreach($xml->channel->children() as $child)
  {

    ///
      if($childs->getName()=="item"){

        foreach($childs->children('geo', TRUE) as $items)
          {
            echo $items->lat->getName() . ": " . $items->lat."<br>";
            echo $items->long->getName() . ": " . $items->long."<br>";

          }

    }
  }

 //          $xmlet = (explode(" ",$xmlt));

//            echo $items->lat->getName() . ": " . $items->lat."<br>";
  //          echo $items->long->getName() . ": " . $items->long."<br>";


?>
