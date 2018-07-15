<?php

require "dbconnection.php";

$sql = "SELECT iddb, lat, long FROM db";
$result = $conn->query($sql);
long
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id : " . $row["iddb"]. " - lat: " . $row["lat"]. "  long : " . $row["long"]. "<br>";
    }
} else {
    echo "results";
}
$conn->close();
?>
