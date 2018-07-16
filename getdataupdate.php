<?php
require "dbconnection.php";
$sql = "SELECT max(iddb), lati, longt FROM db";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc())
     {
        echo "lat : " . $row["lati"]. "  long : " . $row["longt"]. "<br>";
    }
} else
{
    echo "results";
}
$conn->close();
?>