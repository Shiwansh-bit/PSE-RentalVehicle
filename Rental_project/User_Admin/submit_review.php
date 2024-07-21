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

// Get POST data
$vehicle_id = $_POST['vehicle_id'];
$name = $_POST['name'];
$text = $_POST['text'];
$rating = $_POST['rating'];

// Insert review into the database
$query = "INSERT INTO reviews (vehicle_id, name, text, rating) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($query);
$result = $stmt->execute([$vehicle_id, $name, $text, $rating]);

if ($result) {
    echo "Review submitted successfully!";
} else {
    echo "Review submission failed!";
}
?>
