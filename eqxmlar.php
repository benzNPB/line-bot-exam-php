<?php

//$url = "https://www.jma.go.jp/en/quake/quake_singendo_index.html";
           $url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
           $xml1 = simplexml_load_file($url);
           $xml2 = $xml1->channel->item[0]->description;
           $xml3 = $xml1->channel->item[1]->title;
           $xml = (explode(" ",$xml3));
   echo '<pre>';
print_r ($xml3[0]);
	echo '</pre>';
   echo '<pre>';
print_r ($xml2[0]);
	echo '</pre>';

   echo '<pre>';
print_r ($xml);
	echo '</pre>';


?>
