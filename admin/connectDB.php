<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sojib_sports";

// Create a connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
// else {
//     echo "database connection successfull <br>";
// }
