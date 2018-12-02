<?php
$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$xml = simplexml_load_file($url);
//echo $xml->channel->item[0]->description;

$o = strpos($xml->channel->item[0]->description,"20" );
$s = strpos($xml->channel->item[0]->description," " );
$c = strpos($xml->channel->item[0]->description,"k" );
echo substr($xml->channel->item[0]->description,$o+5 ,$s-$o-5);
echo substr($xml->channel->item[0]->description,$s ,$c-$s-3);


?>
