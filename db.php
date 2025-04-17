<?php
$host = "db";
$user = "db";
$password = "db";
$database = "db";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
