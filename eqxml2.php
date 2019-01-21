<?php
$url = "http://www.earthquake.tmd.go.th/feed/rss_inside.xml";
$xml = simplexml_load_file($url);
$o = strpos($xml->channel->item[0]->title,"M" );
$s = strpos($xml->channel->item[0]->title,"," );

echo substr($xml->channel->item[0]->title,$o ,$s-$o);

?>