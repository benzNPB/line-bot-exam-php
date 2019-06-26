<?php
$url = "http://www.gdacs.org/xml/rss.xml";
           $xml = simplexml_load_file($url);
foreach($xml->channel->children() as $childs)
  	{
  		if($childs->getName()=="item"){
  			//echo $childs->title->getName() . ": " . $childs->title."<br>";

  			if(strpos($childs->title,"Indonesia")>0){
  				foreach($childs->children('geo', TRUE) as $items)
			  	{
			  		echo $items->lat->getName() . ": " . $items->lat."<br>";
			  		echo $items->long->getName() . ": " . $items->long."<br>";

			  	}
  			}
  			

  		}
  }
?>
