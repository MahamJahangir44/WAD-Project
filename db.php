<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "mooodmart");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
