<?php
require "dbconnection.php";
$sql = "SELECT max(iddb) as maxa, lati, longt FROM db";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc())
     {
          echo "id : " . $row["maxa"]. " - lat: " . $row["lati"]. "  long : " . $row["longt"]. "<br>";
    }
} else
{
    echo "results";
}
$conn->close();
?>