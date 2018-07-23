<?php

$url = "http://www.earthquake.tmd.go.th/feed/rss_inside.xml";
$xml = simplexml_load_file($url);

echo $xml->channel->title;
//print_r($xml);

?>
