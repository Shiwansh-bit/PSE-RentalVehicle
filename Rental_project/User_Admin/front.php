<?php
// index.php

// Include any necessary files or perform initialization here
// For example, database connection or session start
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RideSathi</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="scripts.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <a href="front.php">
                <img src="../images/logo.png" alt="Logo">
            </a>
        </div>
        <div class="menu-icon">
            <i class="fas fa-bars"></i>
        </div>
        <ul class="nav-links">
            <li><a href="front.php">Home</a></li>
            <li><a href="vehicle.php">Services</a></li>
        </ul>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button type="button">Search</button>
        </div>
    </nav>


    <!-- Hero Section -->
    <div class="hero">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="../images/hero3.jpg" style="width:100%">
                <div class="hero-content">
                    <h1>Welcome to RideSathi</h1>
                    <p>Your journey starts here</p>
                    <a href="signup.php" class="cta-btn">Get Started</a>
                </div>
            </div>
            <div class="mySlides fade">
                <img src="../images/hero.jpg" style="width:100%">
                <div class="hero-content">
                    <h1>Explore Our Services</h1>
                    <p>We have something for everyone</p>
                    <a href="vehicle.php" class="cta-btn">Discover More</a>
                </div>
            </div>
            <!-- Add more slides as needed -->
        </div>
    </div>

    <!-- Info Section -->
    <div class="info">
        <div class="info-content">
            <h2 class="info-title">About Us</h2>
            <p class="info-text">
                We provide exceptional services tailored to your needs. Our dedicated team is here to ensure your satisfaction and deliver the best experience possible.
            </p>
            <a href="#" class="cta-btn">Contact Us</a>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services">
        <div class="service-item" style="background-image: url('../images/var.jpg');">
            <div class="service-content">
                <h3 class="service-title">Fast Booking</h3>
            </div>
        </div>
        <div class="service-item" style="background-image: url('../images/4.jpg');">
            <div class="service-content">
                <h3 class="service-title">Variety Of Vehicles</h3>
            </div>
        </div>
        <div class="service-item" style="background-image: url('../images/hero3.jpg');">
            <div class="service-content">
                <h3 class="service-title">Flexible Renting Options</h3>
            </div>
        </div>
    </div>
    <script>
        // JavaScript to handle menu icon click and slideshow functionality
        $(document).ready(function() {
            $('.menu-icon').click(function() {
                $('.side-menu').toggleClass('active');
                $('.overlay').toggle();
            });
            $('.overlay').click(function() {
                $('.side-menu').removeClass('active');
                $(this).hide();
            });

            let slideIndex = 0;
            function showSlides() {
                let i;
                let slides = $(".mySlides");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex > slides.length) { slideIndex = 1 }
                slides[slideIndex - 1].style.display = "block";
                setTimeout(showSlides, 2000); // Change slide every 2 seconds
            }
            showSlides();
        });
    </script>
</body>
</html>
