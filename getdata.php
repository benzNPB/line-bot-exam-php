<?php

require "dbconnection.php";

$sql = "SELECT iddb, data1, data2 FROM db";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id : " . $row["iddb"]. " - data1: " . $row["data1"]. "  data2 : " . $row["data2"]. "<br>";
    }
} else {
    echo "results";
}
$conn->close();
?>