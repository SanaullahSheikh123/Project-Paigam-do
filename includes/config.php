<?php
// config.php - Database Connection Script

// Database credentials
$servername = "localhost"; 
$username = "root";       
$password = "";          
$dbname = "messanger_project"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully"; // for debugging
}
?>
