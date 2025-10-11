<?php
$conn = mysqli_connect("localhost", "root", "", "bd_voting");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
