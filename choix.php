<?php
// Start the session to handle user data
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planting</title>

    <!-- Link to external style sheets -->
    <link rel="stylesheet" href="./style/footer.css">
    <link rel="stylesheet" href="./style/choix.css">

</head>


<body>
    <!-- Home Section -->
    <section id="container">
        <!-- Header Section -->
        <header>
            <div class="logo">
                <img src="./img/logo2.png" alt="logo">
            </div>
            <!-- menu responsive -->
            <div class="menu-toggle"></div>

            <!-- Navigation Menu -->
            <ul class="menu">
                <li><a href="./home.php">Home</a></li>
                <li><a href="./about.php">About Us</a></li>
                <li><a href="./services.php">Services</a>
                <li><a href="./contact.php">Contact</a></li>
                <?php if (isset($_SESSION['id'])) : ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php else : ?>
                    <li><a href="sign-in.php">Sign-In</a></li>
                <?php endif; ?>
            </ul>
        </header>

        <!-- Container Text Section -->
        <div class="container-text">
            <p>Welcome to our Planting Guide and Location Selection page. Here, you have the power to choose between
                optimizing your garden's layout with our Location Selection feature or delving into the intricacies of
                plant growth with our Planting Guide. Tailor your gardening experience to your preferences and watch
                your garden thrive. <br><span class="happy">Happy gardening <i class="fa fa-pagelines" aria-hidden="true" style="color: #2fc665;"></i></span> </p>
            <div class="boutton-a">
                <a href="./locat.php">Location Selection</a>
                <a href="./guide.php">planting Guide</a>
            </div>
        </div>
    </section>

    <!-- Location Selection Section -->
    <section id="location">
        <div>
            <!-- Title for Location Selection -->
            <p class="tittle-section"> Location Selection</p>
            <!-- Text and Photo Section -->
            <div class="text-photo">
                <div class="text">
                    <!-- Description of Location Selection -->
                    <p>Welcome to our gardening guide dedicated to the "Location Planting" section. Here, we provide
                        advice on the ideal locations to cultivate different plants, tailored to their specific needs.
                        By selecting your favorite plant, you'll receive detailed information on the optimal conditions
                        for its growth.

                        This customization allows you to optimize your gardening space based on the specific
                        requirements of each plant, promoting robust growth and fruitful yields. Explore our detailed
                        tips for each plant of your choice and transform your garden into a flourishing and harmonious
                        space. </p>
                    <!-- Button to navigate to the Location Selection page -->
                    <button class="button-link">
                        <a href="./locat.php">Location</a>
                    </button>
                </div>
                <img src="./img/location.jpg" alt="">
            </div>
        </div>
    </section>

    <!-- Planting Guide Section -->
    <section id="location">
        <div>

            <!-- Title for Planting Guide -->
            <p class="tittle-section"> Planting Guide</p>

            <!-- Text and Photo Section -->
            <div class="text-photo">
                <div class="text">

                    <!-- Description of Planting Guide -->
                    <p>Our Planting Guide aims to assist you in making informed decisions about when to plant each crop,
                        maximizing your agricultural productivity. Tailored to the unique requirements of different crops,
                        this guide enables you to plan your planting schedule effectively. Unlock the potential of your agricultural
                        endeavors by exploring our comprehensive tips for each crop, ensuring a thriving and fruitful harvest.
                        Transform your agricultural practices with our detailed insights, promoting the success of your farming
                        venture. </p>
                    <!-- Button to navigate to the Planting Guide page -->
                    <button class="button-link">
                        <a href="./guide.php">Guide</a>
                    </button>
                </div>
                <img src="./img/etiquette1.jpg" alt="">
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>
    </footer>

    <!-- Script for responsive menu -->
    <script src="./jss/menu.js"></script>
</body>

</html>