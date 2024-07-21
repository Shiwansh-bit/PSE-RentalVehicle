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

// Get vehicle ID from query string
$vehicle_id = $_GET['vehicle_id'];

// Fetch maintenance log
$sql = "SELECT * FROM maintenance_log WHERE vehicle_id = ? ORDER BY date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $vehicle_id);
$stmt->execute();
$result = $stmt->get_result();

$log = array();
while ($row = $result->fetch_assoc()) {
    $log[] = $row;
}

echo json_encode($log);

$stmt->close();
$conn->close();
?>
