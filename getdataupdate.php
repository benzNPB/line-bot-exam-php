<?php
require "dbconnection.php";
$sql = "SELECT max(iddb) as maxa, max(lati) as litmax, longt FROM db";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc())
     {
          echo "id : " . $row["maxa"]. " - lat: " . $row["litmax"]. "  long : " . $row["longt"]. "<br>";
    }
} else
{
    echo "results";
}
$conn->close();
?>