<?php
define("DB_NAME", "car_bookings");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_HOST", "localhost");

function connect() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>