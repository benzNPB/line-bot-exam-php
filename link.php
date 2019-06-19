<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$url = 'https://www.bousai.pref.kanagawa.jp/?fbclid=IwAR2o4skyEIe50B9UMnFxumz7M0N0vSEVBoZLtuYGTKRq8QKsimFugQLz_4I';
//file_get_contents($url)
echo file_get_contents($url);
   
?>