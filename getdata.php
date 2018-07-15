<?php

require "dbconnection.php";

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