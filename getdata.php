<?php
$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "bf77fe5230f3fe";
$password = "c963cd151a552ea";
$dbname = "heroku_8b2a3c1ec4fd3a5";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT iddb, status, stat FROM db";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id : " . $row["iddb"]. " - status: " . $row["status"]. "  stat : " . $row["stat"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>