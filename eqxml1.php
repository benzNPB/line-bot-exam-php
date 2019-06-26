<?php
           $url = "http://www.gdacs.org/xml/rss.xml";
           $xml = simplexml_load_file($url);
           $xml1 = simplexml_load_string($url);
           $xmlt = $xml->channel->item[0]->description;
           $xmlet = (explode(" ",$xmlt));
               echo '<pre>';
echo $xmlt;
               echo '</pre>';
               echo '<pre>';
echo $xml1;
               echo '</pre>';

?>
