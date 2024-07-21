<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicledb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3308);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$vehicle_id = $_POST['vehicle_id'];
$details = $_POST['details'];
$date = date('Y-m-d'); // Current date

// Insert maintenance record
$sql = "INSERT INTO maintenance_log (vehicle_id, details, date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $vehicle_id, $details, $date);

if ($stmt->execute()) {
    echo "Maintenance record added successfully.";
} else {
    echo "Error adding maintenance record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
