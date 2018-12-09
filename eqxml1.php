<?php
$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$xml1 = simplexml_load_file($url);
$xml2 = $xml1->channel->item[0]->description;
$xml = (explode(" ",$xml2));
echo $xml[3].','.$xml[6];
?>
