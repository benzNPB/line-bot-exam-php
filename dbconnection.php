<?php
$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "bf77fe5230f3fe";
$password = "c963cd151a552ea";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>