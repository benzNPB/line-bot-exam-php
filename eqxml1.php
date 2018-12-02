<?php
$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$xml = simplexml_load_file($url);
echo $xml->channel->item[0]->description;

$o = strpos($xml->channel->item[0]->description,"2" );
$s = strpos($xml->channel->item[0]->description," " );
$c = strpos($xml->channel->item[0]->description,")" );
echo substr($xml->channel->item[0]->description,$o+19 ,$s-$o-1);


?>
