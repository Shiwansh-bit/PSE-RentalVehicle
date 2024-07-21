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

$sql = "DELETE FROM vehicles WHERE id = $vehicle_id";
if ($conn->query($sql) === TRUE) {
    echo "Vehicle deleted successfully.";
} else {
    echo "Error deleting vehicle: " . $conn->error;
}

$conn->close();
?>
