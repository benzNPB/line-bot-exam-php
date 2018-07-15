<?php

require "dbconnection.php";

$sql = "SELECT iddb, lat, long FROM db";
$result = $conn->query($sql);
WHERE iddb = (SELECT MAX(iddb) FROM db WHERE iddb = 'iddb')
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc())
     {
     	        echo "id : " . $row["iddb"]. " - lat: " . $row["lat"]. "  long : " . $row["long"]. "<br>";
     }
} else {
    echo "results";
}
$conn->close();
?>
