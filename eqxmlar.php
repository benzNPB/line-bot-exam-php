<?php
$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
//$url = "https://www.jma.go.jp/en/quake/quake_singendo_index.html";
$xml1 = simplexml_load_file($url);
$xml2 = $xml1->channel->item[0];

print_r ($xml2);

?>
