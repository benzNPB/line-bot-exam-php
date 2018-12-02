<?php
$url = "http://webcritech.jrc.ec.europa.eu/ModellingTsunami/TsunamiSurge/JETS_System/2018/12/30373/locations.xml";
$xml = simplexml_load_file($url);

echo $xml->channel->item[0]->title;

?>
