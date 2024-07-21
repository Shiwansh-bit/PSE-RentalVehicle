<?php
// Database connection
$host = 'localhost';
$dbname = 'rental';
$username = 'root';
$password = ''; // Update with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;port=3308", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Get vehicle_id from query parameters
$vehicle_id = $_GET['vehicle_id'];

// Fetch reviews from the database
$query = "SELECT * FROM reviews WHERE vehicle_id = ? ORDER BY review_date DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$vehicle_id]);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($reviews);
?>
