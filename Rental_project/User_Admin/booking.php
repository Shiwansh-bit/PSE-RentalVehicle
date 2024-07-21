<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="booking.css">
    <title>Booking Vehicle</title>
    <script>
        function calculateTotalCost() {
            const pricePerDay = parseFloat(document.getElementById('pricePerDay').value);
            const pickupDate = new Date(document.getElementById('pickup-date').value);
            const dropoffDate = new Date(document.getElementById('dropoff-date').value);

            if (pickupDate && dropoffDate && !isNaN(pricePerDay)) {
                const timeDiff = dropoffDate - pickupDate;
                const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                const totalCost = days * pricePerDay;

                document.getElementById('totalCost').innerText = `Total Cost: $${totalCost.toFixed(2)}`;
            } else {
                document.getElementById('totalCost').innerText = 'Total Cost: $0.00';
            }
        }

        window.onload = function() {
            document.getElementById('pickup-date').addEventListener('change', calculateTotalCost);
            document.getElementById('dropoff-date').addEventListener('change', calculateTotalCost);
        };

        function showPopup(message) {
            document.getElementById('confirmationMessage').innerText = message;
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function submitBooking(event) {
            event.preventDefault();
            const bookingForm = document.getElementById('bookingForm');
            const formData = new FormData(bookingForm);
            fetch('submit_booking.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                showPopup(data);
            })
            .catch(error => console.error('Error submitting booking:', error));
        }
    </script>
</head>
<body>
    <section class="container">
        <div class="info">
            <div class="top">
                <?php
                $vehicle_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "vehicledb";
                $port = 3308;

                $conn = new mysqli($servername, $username, $password, $dbname, $port);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM vehicles WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $vehicle_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $vehicle = $result->fetch_assoc();
                    $pricePerDay = htmlspecialchars($vehicle["price_per_day"]);

                    echo '<img src="images/' . htmlspecialchars($vehicle["image"]) . '" alt="Car Image" class="vehicle-image">';
                    echo '<p class="vehicle-name">' . htmlspecialchars($vehicle["name"]) . '</p>';
                    echo '<p class="vehicle-model">' . htmlspecialchars($vehicle["model"]) . '</p>';
                    echo '<p class="vehicle-year">' . htmlspecialchars($vehicle["year"]) . '</p>';
                    echo '<input type="hidden" id="pricePerDay" value="' . $pricePerDay . '">';
                } else {
                    echo '<p>Vehicle not found.</p>';
                }

                $stmt->close();
                $conn->close();
                ?>
            </div>
        </div>
        <div class="booking">
            <h2>Vehicle Booking Form</h2>
            <form id="bookingForm" onsubmit="submitBooking(event)">
                <input type="hidden" id="vehicleId" name="vehicle_id" value="<?php echo htmlspecialchars($vehicle_id); ?>">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="pickup-date">Pickup Date:</label>
                        <input type="date" id="pickup-date" name="pickup-date" required>
                    </div>
                    <div class="form-group">
                        <label for="dropoff-date">Dropoff Date:</label>
                        <input type="date" id="dropoff-date" name="dropoff-date" required>
                    </div>
                </div>
                <p id="totalCost">Total Cost: $0.00</p>
                <button type="submit">Book Now</button>
            </form>
        </div>

        <!-- Comments and Ratings Section -->
        <div class="review-section">
            <h2>Leave a Review</h2>
            <form id="reviewForm" onsubmit="submitReview(); return false;">
                <div class="form-row">
                    <div class="form-group">
                        <label for="review-name">Name:</label>
                        <input type="text" id="review-name" name="review-name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="review-text">Review:</label>
                        <textarea id="review-text" name="review-text" rows="4" placeholder="Leave your review here..." required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group rating-group">
                        <label for="review-rating">Rating:</label>
                        <div class="rating">
                            <input type="radio" id="review-rating-5" name="review-rating" value="5"><label for="review-rating-5">&#9733;</label>
                            <input type="radio" id="review-rating-4" name="review-rating" value="4"><label for="review-rating-4">&#9733;</label>
                            <input type="radio" id="review-rating-3" name="review-rating" value="3"><label for="review-rating-3">&#9733;</label>
                            <input type="radio" id="review-rating-2" name="review-rating" value="2"><label for="review-rating-2">&#9733;</label>
                            <input type="radio" id="review-rating-1" name="review-rating" value="1"><label for="review-rating-1">&#9733;</label>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="review-vehicle_id" name="vehicle_id" value="<?php echo htmlspecialchars($_GET['vehicle_id']); ?>">
                <button type="submit">Submit Review</button>
            </form>

            <!-- Display Reviews -->
            <div id="reviews-list" class="reviews-list">
                <!-- Reviews will be dynamically loaded here -->
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <p id="confirmationMessage"></p>
        </div>
    </div>

    <!-- Modal CSS -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</body>
</html>
