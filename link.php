<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//$url = 'http://www.jma.go.jp/jp/quake/quake_local_index.html';
$url = 'https://www.bousai.pref.kanagawa.jp/K_PUB_VF_DetailCity?cityid=a017F00000G5BtgQAF&shibucode=S06';
$link = file_get_contents($url);
//echo file_get_contents($url);

//$o = strpos($link,"情報発表日時" );
//$s = strpos($link,"震度" );
//echo substr($link,$o ,$s-$o);

$o = strpos($link,"情報" );
$s = strpos($link,"）" );
             echo '<pre>';
          echo $link;
           echo '</pre>';
               echo '<pre>';
            echo substr($link,$o,$s-$o);
               echo '</pre>';

?>
