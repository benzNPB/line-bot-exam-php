<?php
$url = "http://www.earthquake.tmd.go.th/feed/rss_inside.xml";
$xml = simplexml_load_file($url);
echo $xml->channel->title;
echo $xml->item[1]->title;
echo $xml->item->[1]->title;
echo "<br><br><br>";
print_r($xml);

?>
