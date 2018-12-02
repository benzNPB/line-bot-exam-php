<?php
$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$xml = simplexml_load_string($url);
echo $xml->channel->item[0];

?>
