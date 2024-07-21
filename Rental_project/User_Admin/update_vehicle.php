<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vehicledb";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$vehicle_id = $data['vehicle_id'];
$availability = $data['availability'];

$sql = "UPDATE vehicles SET availability = '$availability' WHERE id = $vehicle_id";
if ($conn->query($sql) === TRUE) {
    echo "Vehicle availability updated successfully.";
} else {
    echo "Error updating availability: " . $conn->error;
}

$conn->close();
?>
