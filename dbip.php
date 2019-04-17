<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO updatedb (lat, long, Mag)

$url = "http://geofon.gfz-potsdam.de/eqinfo/list.php?fmt=rss";
        $xml1 = simplexml_load_file($url);
        $xml2 = $xml1->channel->item[0]->description;
        $xmlt = $xml1->channel->item[0]->title;
        $xml = (explode(" ",$xml2));
VALUES ($xml[3], $xml[6])";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>