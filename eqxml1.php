<?php
$url = "https://reliefweb.int/disasters/rss.xml?country=120";
$xml = simplexml_load_file($url);

echo substr($xml);

?>