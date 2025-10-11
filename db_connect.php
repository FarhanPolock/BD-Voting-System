<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "bd_voting";
try {
    $conn = new mysqli($servername, $username, $password, $database);
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>