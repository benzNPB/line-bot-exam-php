<?php
$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
//$url = "https://www.jma.go.jp/en/quake/quake_singendo_index.html";
$xml1 = simplexml_load_file($url);
$xml2 = $xml1->channel->item[0]->title;
$xml = (explode(" ",$xml2));
print_r ($xml2);
echo $xml2.':'.$xml[3].','.$xml[6];

?>
