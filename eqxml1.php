<?php
$url = "http://www.gdacs.org/xml/rss.xml";
$xml = simplexml_load_file($url);

echo $xml;

?>
