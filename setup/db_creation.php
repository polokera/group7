<?php
require_once 'setup.php';

$conn = connect();

$sql_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;

if ($conn->query($sql_db) === TRUE) {
    $conn->select_db(DB_NAME);

    $usersTable = "CREATE TABLE IF NOT EXISTS Users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        user_type VARCHAR(20), 
        phone_number VARCHAR(20),
        university_id VARCHAR(50) UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $vehiclesTable = "CREATE TABLE IF NOT EXISTS Vehicles (
        vehicle_id INT AUTO_INCREMENT PRIMARY KEY,
        plate_number VARCHAR(20) UNIQUE NOT NULL,
        model_name VARCHAR(50) NOT NULL,
        vehicle_type VARCHAR(20),
        capacity INT NOT NULL,
        status VARCHAR(20) DEFAULT 'Available',
        last_service_date DATE
    )";

    $driversTable = "CREATE TABLE IF NOT EXISTS Driver_Details (
        driver_id INT PRIMARY KEY,
        license_number VARCHAR(50) UNIQUE NOT NULL,
        license_expiry DATE NOT NULL,
        is_available BOOLEAN DEFAULT TRUE,
        FOREIGN KEY (driver_id) REFERENCES Users(user_id) ON DELETE CASCADE
    )";

    $bookingsTable = "CREATE TABLE IF NOT EXISTS Bookings (
        booking_id INT AUTO_INCREMENT PRIMARY KEY,
        requester_id INT NOT NULL,
        vehicle_id INT,
        driver_id INT,
        admin_id INT,
        pickup_location VARCHAR(255) NOT NULL,
        destination VARCHAR(255) NOT NULL,
        departure_time DATETIME NOT NULL,
        return_time DATETIME NOT NULL,
        actual_return_time DATETIME,
        purpose TEXT,
        late_fee DECIMAL(10, 2) DEFAULT 0.00,
        rejection_reason TEXT,
        status VARCHAR(20) DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (requester_id) REFERENCES Users(user_id),
        FOREIGN KEY (vehicle_id) REFERENCES Vehicles(vehicle_id),
        FOREIGN KEY (driver_id) REFERENCES Users(user_id),
        FOREIGN KEY (admin_id) REFERENCES Users(user_id)
)";


    $tables = [
        "Users" => $usersTable,
        "Vehicles" => $vehiclesTable,
        "Driver_Details" => $driversTable,
        "Bookings" => $bookingsTable
    ];

    foreach ($tables as $name => $query) {
        if ($conn->query($query) === TRUE) {
            echo "Table $name settled successfully.<br>";
        } else {
            echo "Error creating $name: " . $conn->error . "<br>";
        }
    }

} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>