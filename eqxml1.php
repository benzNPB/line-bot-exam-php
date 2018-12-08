<?php
$url = "http://www.gdacs.org/xml/rss.xml";
$xml = simplexml_load_file($url);
echo $xml->channel->item[0]->geo:Point->geo:lat->geo:long;

//$o = strpos($xml->channel->item[0]->description,"2018" );
//$s = strpos($xml->channel->item[0]->description," " );
//$c = strpos($xml->channel->item[0]->description,"km" );
//echo substr($xml->channel->item[0]->description,$o+16,$c-$s-5);
//echo substr($xml->channel->item[0]->description,$o+20 ,$c-$s-15);
//echo $xml->channel->item[0]->title;

?>
