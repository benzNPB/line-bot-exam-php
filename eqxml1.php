<?php
//$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$url = "http://agora.ex.nii.ac.jp/earthquake/hypocenter/#xml";
$xml1 = simplexml_load_file($url);
//$xml2 = $xml1->channel->item[0]->description;
//$xml3 = $xml1->channel->item[0]->title;
//$xml = (explode(" ",$xml2));
//echo $xml3.':'.$xml[3].','.$xml[6];
echo $xml1;
?>
