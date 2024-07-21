<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Company - Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../images/logo.png" alt="Logo">
        </div>
        <ul class="nav-links">
            <li><a href="vehicle.php">Available Vehicles</a></li>
            <li><a href="exp.html">Location</a></li>
        </ul>
    </nav>

    <section class="admin-section">
        <!-- Add New Vehicle -->
        <div class="admin-card">
            <h3>Add New Vehicle</h3>
            <form id="add-vehicle-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="model">Model:</label>
                <input type="text" id="model" name="model" required>
                
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" required>
                
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" required>
                
                <label for="image">Image Filename:</label>
                <input type="text" id="image" name="image" required>
                
                <label for="price">Price per Day:</label>
                <input type="number" id="price" name="price" step="0.01" min="0" required>
                
                <button type="submit">Add Vehicle</button>
            </form>
        </div>

        <!-- Manage Vehicles -->
        <div class="admin-card">
            <h3>Manage Vehicles</h3>
            <ul id="vehicle-list"></ul>
        </div>
    </section>

    <script>
        // Fetch vehicles data
        function fetchVehicles() {
            fetch('get_vehicles.php')
                .then(response => response.json())
                .then(data => {
                    const vehicleList = document.getElementById('vehicle-list');
                    vehicleList.innerHTML = '';
                    data.forEach(vehicle => {
                        const li = document.createElement('li');
                        li.innerHTML = `
                            ${vehicle.name} - ${vehicle.model} (${vehicle.year})
                            <button onclick="deleteVehicle(${vehicle.id})">Delete</button>
                            <button onclick="markUnavailable(${vehicle.id})">Mark Unavailable</button>
                        `;
                        vehicleList.appendChild(li);
                    });
                });
        }

        // Add new vehicle
        document.getElementById('add-vehicle-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);

            fetch('add_vehicle.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                this.reset();
                fetchVehicles();
            });
        });

        // Delete vehicle
        function deleteVehicle(vehicleId) {
            if (confirm('Are you sure you want to delete this vehicle?')) {
                fetch('delete_vehicle.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ vehicle_id: vehicleId }),
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    fetchVehicles();
                });
            }
        }

        // Initialize page
        fetchVehicles();
    </script>
</body>
</html>
