<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$url = 'http://www.jma.go.jp/jp/quake/quake_local_index.html';
//file_get_contents($url)
echo file_get_contents($url);
   
?>
