<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $dbname = "vehicledb";
    
    $conn = new mysqli($servername, $username, "", $dbname, 3308);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user from database
    $stmt = $conn->prepare("SELECT id, fullname, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $fullname, $hashedPassword);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Verify password
        if (password_verify($password, $hashedPassword)) {
            // Store user info in session
            $_SESSION['userid'] = $id;
            $_SESSION['fullname'] = $fullname;
            header("Location: front.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with that email!";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="front.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <a href="signup.php" class="signup-link">Don't have an account? Sign up here.</a><br>
        <a href="admin.php" class="signup-link">Are you an admin?</a>
    </div>
</body>
</html>
