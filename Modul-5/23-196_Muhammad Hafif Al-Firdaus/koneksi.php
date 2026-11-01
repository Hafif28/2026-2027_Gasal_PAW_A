<?php
// Materi 1: Koneksi database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "tp5";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

return $conn;
?>
