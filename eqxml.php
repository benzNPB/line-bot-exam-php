<?php

$url = "http://www.earthquake.tmd.go.th/feed/rss_inside.xml";
$xml = simplexml_load_file($url);

//echo $xml->channel->title;

echo $xml->item[1]->title;
//print_r($xml);

?>
