<?php
//$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$url = "http://agora.ex.nii.ac.jp/earthquake/hypocenter/#xml";
$xml1 = simplexml_load_file($url);
$xml2 = $xml1->channel->item[0]->description;

print_r (explode(" ",$xml2));

?>
