<?php
// submit_booking.php
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

$vehicle_id = $_POST['vehicle_id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pickup_date = $_POST['pickup-date'];
$dropoff_date = $_POST['dropoff-date'];

$sql = "INSERT INTO bookings (vehicle_id, firstname, lastname, email, phone, pickup_date, dropoff_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssss", $vehicle_id, $firstname, $lastname, $email, $phone, $pickup_date, $dropoff_date);

if ($stmt->execute()) {
    echo "Booking successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
