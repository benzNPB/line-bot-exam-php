<?php
$url = "http://www.gdacs.org/xml/rss.xml";
$xml1 = simplexml_load_file($url);
$xml2 = $xml1->channel->item[0]->geo:Point->georss:point;

echo $xml2;
?>
