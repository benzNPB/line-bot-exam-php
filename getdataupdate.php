
<?php
require "dbconnection.php";
$sql = "SELECT * FROM iddb WHERE No=(SELECT max(No) FROM iddb)";
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