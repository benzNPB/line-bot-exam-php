<?php
$url = "http://www.gdacs.org/xml/rss.xml";
$xml = simplexml_load_string($url);
echo $xml->channel->item[1]->geo:Point;

?>
