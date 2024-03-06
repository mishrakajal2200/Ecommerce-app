<?php
// $conn = mysqli_connect("127.0.0.1","root","","e_commerce")
//         or die("couldn't connect with database")

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "e_commerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


