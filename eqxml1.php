<?php
           $url = "http://www.gdacs.org/xml/rss.xml";
           $xml = simplexml_load_file($url);
           $xmlt = $xml->channel->item[0]->description;
           $xmlet = (explode(" ",$xmlt));
echo $xmlet;

?>
