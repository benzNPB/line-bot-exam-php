<?php
$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$xml1 = simplexml_load_file($url);
$xml2 = $xml1->channel->item[0]->description;
$xml = (explode(" ",$xml2));
echo $xml[3].','.$xml[6];


//$o = strpos($xml->channel->item[0]->description,"2018" );
//$s = strpos($xml->channel->item[0]->description," " );
//$c = strpos($xml->channel->item[0]->description,"km" );
//echo substr($xml->channel->item[0]->description,$o+16,$c-$s-5);
//echo substr($xml->channel->item[0]->description,$o+20 ,$c-$s-15);
//echo $xml->channel->item[0]->title;

?>
