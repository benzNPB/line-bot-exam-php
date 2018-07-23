<?php
$url = "http://www.earthquake.tmd.go.th/feed/rss_inside.xml";
$xml = simplexml_load_file($url);
//echo $xml->channel->title;
//echo $xml->channel->item[1]->title;
$o = strpos($xml->channel->item[0]->title,"(" );
$c = strpos($xml->channel->item[0]->title,")" );
echo substr($xml->channel->item[0]->title,$o+1 ,$c-$o-1);
?>
