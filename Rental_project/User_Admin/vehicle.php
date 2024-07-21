<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Vehicles</title>
    <link rel="stylesheet" href="vehicle.css">
</head>
<body>
    <header>
        <h1>Available Vehicles</h1>
    </header>
    <main class="body">
        <div class="container">
            <?php
            // Database connection
            $servername = "localhost"; // Change to your server name
            $username = "root"; // Change to your database username
            $password = ""; // Change to your database password
            $dbname = "vehicledb"; // Change to your database name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname, 3308);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to get vehicle data
            $sql = "SELECT * FROM vehicles";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data for each vehicle
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="vehicle-card">';
                    echo '<div class="vehicle-top">';
                    echo '<img src="images/' . htmlspecialchars($row["image"]) . '" alt="Car Image">';
                    echo '</div>';
                    echo '<div class="vehicle-bottom">';
                    echo '<p class="vehicle-name">' . htmlspecialchars($row["name"]) . '</p>';
                    echo '<p class="vehicle-model">' . htmlspecialchars($row["model"]) . '</p>';
                    echo '<p class="vehicle-type">' . htmlspecialchars($row["type"]) . '</p>';
                    echo '<p class="vehicle-year">' . htmlspecialchars($row["year"]) . '</p>';
                    echo '<a href="booking.php?id=' . $row["id"] . '" class="book-btn">Book Now</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No vehicles available.</p>';
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>
