<?php
require "dbconnection.php";
mysql_select_db("db");

mysql_query("SET NAMES UTF8");

$q=mysql_query("SELECT * FROM tb_sys WHERE No=(
    SELECT max(No) FROM iddb
    )");
while($e=mysql_fetch_assoc($q))
       $output[]=$e;
$result = mysql_query($query);
print(json_encode($output));
mysql_close();
?>