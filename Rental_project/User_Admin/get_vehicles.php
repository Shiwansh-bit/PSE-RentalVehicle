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

$sql = "SELECT id, name, model, year FROM vehicles";
$result = $conn->query($sql);

$vehicles = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $vehicles[] = $row;
    }
}

echo json_encode($vehicles);

$conn->close();
?>
