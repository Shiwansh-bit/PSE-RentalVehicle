<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db= "vehicledb";
    $conn = mysqli_connect($hostname, $username, $password, $db,3308);
    if ($conn->connect_error)
    {
        die("connection failed" .$conn->connect_error);
        
    }

    echo "Database connected";

    $conn->close();
    ?>
