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

$name = $_POST['name'];
$model = $_POST['model'];
$type = $_POST['type'];
$year = $_POST['year'];
$image = $_POST['image'];
$price_per_day = $_POST['price'];

$sql = "INSERT INTO vehicles (name, model, type, year, image, price_per_day, availability) VALUES ('$name', '$model', '$type', $year, '$image', $price_per_day, 'available')";
if ($conn->query($sql) === TRUE) {
    echo "New vehicle added successfully.";
} else {
    echo "Error adding vehicle: " . $conn->error;
}

$conn->close();
?>
