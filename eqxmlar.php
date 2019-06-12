<?php
//$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
$url = "http://agora.ex.nii.ac.jp/cgi-bin/cps/report_list.pl?type=%E3%82%A2%E3%82%B8%E3%82%A2%E5%A4%AA%E5%B9%B3%E6%B4%8B%E5%9C%B0%E4%B8%8A%E5%AE%9F%E6%B3%81%E5%9B%B3&office=%E6%B0%97%E8%B1%A1%E5%BA%81%E6%9C%AC%E5%BA%81";
$xml1 = simplexml_load_file($url);
$xml2 = $xml1->channel->item[0]->description;

print_r (explode(" ",$xml2));

?>
