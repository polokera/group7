<?php
require_once 'setup.php';
$conn = connect();
$conn->select_db(DB_NAME);

$users = "INSERT IGNORE INTO Users (user_id, full_name, email, password_hash, user_type) VALUES 
(1, 'System Admin', 'admin@uni.com', 'hash123', 'Admin'),
(2, 'John Student', 'john@uni.com', 'hash123', 'Student'),
(3, 'Alice Student', 'alice@uni.com', 'hash123', 'Student'),
(4, 'Bob Student', 'bob@uni.com', 'hash123', 'Student'),
(5, 'Dr. Smith', 'smith@uni.com', 'hash123', 'Lecturer'),
(6, 'Prof. Brown', 'brown@uni.com', 'hash123', 'Lecturer'),
(7, 'Mike Driver', 'mike@uni.com', 'hash123', 'Driver'),
(8, 'Sarah Driver', 'sarah@uni.com', 'hash123', 'Driver')";

$drivers = "INSERT IGNORE INTO Driver_Details (driver_id, license_number, license_expiry, is_available) VALUES 
(7, 'DL-99001', '2025-12-31', 1),
(8, 'DL-99002', '2026-06-15', 1)";

$vehicles = "INSERT IGNORE INTO Vehicles (vehicle_id, plate_number, model_name, vehicle_type, capacity, status) VALUES 
(1, 'KAB 101', 'Toyota Hiace', 'Bus', 14, 'Available'),
(2, 'KAB 202', 'Toyota Camry', 'Sedan', 5, 'Booked'),
(3, 'KAB 303', 'Ford Everest', 'SUV', 7, 'Maintenance'),
(4, 'KAB 404', 'Honda Civic', 'Sedan', 5, 'Available'),
(5, 'KAB 505', 'Isuzu Coaster', 'Bus', 30, 'Available'),
(6, 'KAB 606', 'Mitsubishi Pajero', 'SUV', 7, 'Available')";

$bookings = "INSERT IGNORE INTO Bookings (booking_id, requester_id, vehicle_id, driver_id, admin_id, pickup_location, destination, departure_time, return_time, actual_return_time, status, late_fee) VALUES 
(1, 2, 1, 7, 1, 'Main Gate', 'City Center', '2023-10-01 08:00', '2023-10-01 12:00', '2023-10-01 14:00', 'Completed', 200.00),
(2, 5, 2, 8, 1, 'Science Block', 'Research Site', '2023-10-05 09:00', '2023-10-05 17:00', '2023-10-05 17:00', 'Completed', 0.00),
(3, 3, 4, 7, 1, 'Hostel A', 'Sports Complex', '2023-11-01 10:00', '2023-11-01 13:00', '2023-11-01 13:30', 'Completed', 100.00),
(4, 6, 1, 8, 1, 'Admin Block', 'Airport', '2023-11-10 05:00', '2023-11-10 10:00', '2023-11-10 10:00', 'Completed', 0.00),
(5, 4, 5, 7, 1, 'Main Gate', 'Field Trip', '2023-11-12 07:00', '2023-11-12 18:00', '2023-11-12 19:00', 'Completed', 100.00),
(6, 2, 2, 8, 1, 'Hostel B', 'Museum', '2023-11-15 09:00', '2023-11-15 14:00', NULL, 'Approved', 0.00),
(7, 5, 6, 7, 1, 'Faculty', 'Hotel', '2023-11-20 18:00', '2023-11-20 21:00', NULL, 'Pending', 0.00),
(8, 3, 4, 8, 1, 'Library', 'City Mall', '2023-11-21 11:00', '2023-11-21 14:00', NULL, 'Pending', 0.00),
(9, 6, 1, 7, 1, 'Science Lab', 'Secondary School', '2023-11-22 08:00', '2023-11-22 15:00', NULL, 'Rejected', 0.00),
(10, 4, 5, 8, 1, 'Main Gate', 'Convention Center', '2023-11-25 08:00', '2023-11-25 17:00', NULL, 'Approved', 0.00)";

$tables = [
    "Users" => $users,
    "Drivers" => $drivers,
    "Vehicles" => $vehicles,
    "Bookings" => $bookings,
];
foreach ($tables as $table => $columns) {
    if ($conn->query($columns) === true) {
        echo "Table $table data successfully added <br>";
    } else {
        echo "Table $table data failed to add" . $conn->error . "<br>";
    }
}

$conn->close();
?>