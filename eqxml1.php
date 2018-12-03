<?php
$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$xml = simplexml_load_file($url);
//echo $xml->channel->item[0]->description;

$o = strpos($xml->channel->item[0]->description,"2018" );
$s = strpos($xml->channel->item[0]->description," " );
$c = strpos($xml->channel->item[0]->description,"k" );
//echo substr($xml->channel->item[0]->description,$o);
echo substr($xml->channel->item[0]->description,$c+$s+3 ,$c-$s-3);


?>
