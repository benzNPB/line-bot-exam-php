<?php

//$url = "https://www.jma.go.jp/en/quake/quake_singendo_index.html";
           $url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
           $xml1 = simplexml_load_file($url);
           $xmld = $xml1->channel->item[0]->description;
           $xmlt = $xml1->channel->item[0]->title;
           $xmlet = (explode(" ",$xmlt));
           $xmled = (explode(" ",$xmld));
   echo '<pre>';
print_r ($xmlt[0]);
	echo '</pre>';
   echo '<pre>';
print_r ($xmld[0]);
	echo '</pre>';

   echo '<pre>';
print_r ($xmlet);
	echo '</pre>';
   echo '<pre>';
print_r ($xmled);
	echo '</pre>';

?>
