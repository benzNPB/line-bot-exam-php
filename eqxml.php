<?php
$url = "http://www.earthquake.tmd.go.th/feed/rss_inside.xml";
$xml = simplexml_load_file($url);
//echo $xml->channel->title;
//echo $xml->channel->item[1]->title;
$o = strpos($xml->channel->item[0]->title,"(" );
$s = strpos($xml->channel->item[0]->title,"," );
$c = strpos($xml->channel->item[0]->title,")" );
echo substr($xml->channel->item[0]->title,$o+1 ,$s-$o-1);
echo substr($xml->channel->item[0]->title,$s+1 ,$c-$s-1);



//$o = strpos($xml->channel->item[0]->description,"2018" );
//$s = strpos($xml->channel->item[0]->description," " );
//$c = strpos($xml->channel->item[0]->description,"km" );
//echo substr($xml->channel->item[0]->description,$o+16,$c-$s-5);
//echo substr($xml->channel->item[0]->description,$o+20 ,$c-$s-15);
//echo $xml->channel->item[0]->title;
?>

