<?php
require "dbconnection.php";
$sql = "SELECT * FROM db WHERE iddb=(SELECT max(iddb) FROM db)";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc())
     {
        echo "id : " . $row["iddb"] "<br>";
    }
} else {
    echo "results";
}
$conn->close();
?>