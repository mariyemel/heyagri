<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- External stylesheets, including Font Awesome icons and custom styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/about.css">
    <link rel="stylesheet" href="./style/footer.css">
</head>

<body>
    <!-- Header section, including logo, responsive menu toggle, and navigation links -->
    <header>
        <div class="logo">
            <img src="./img/logo2.png" alt="logo">
        </div>
        <!-- Responsive menu toggle icon -->
        <div class="menu-toggle"></div>
        <ul class="menu">
            <li><a href="./home.php">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="./services.php">Services</a>
            <li><a href="./contact.php">Contact</a></li>
            <!-- Display "Déconnexion" or "Sign-In" based on user session -->
            <?php if (isset($_SESSION['id'])) : ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="sign-in.php">Sign-In</a></li>
            <?php endif; ?>
        </ul>
    </header>
    <!-- Heading section with page title and a brief welcoming message -->
    <div class="heading">
        <h1>About Us</h1>
        <p>Welcome to HeyAgri, where our love for gardening meets sustainable urban living.</p>
    </div>
    <!-- Main content container -->
    <div class="container">
        <!-- Section providing information about the team and its mission -->
        <section class="about">
            <div class="about-image">
                <img src="./img/jardin.jpg" alt="">
            </div>
            <!-- Content describing who the team is and its mission -->
            <div class="about-content">
                <h2>Who We Are </h2>
                <p>We are a group of computer science students who have embarked on a bold project by delving into the
                    field of agriculture. United by our love for technology and our desire to contribute to a more
                    sustainable environment, we have decided to leverage our computer science skills in the realm of
                    urban gardening.</p>
                <h2>Our mission</h2>
                <p>At HeyAgri, our mission is to optimize urban gardening for efficiency and environmental impact. We
                    aim to empower individuals and communities to grow their own fresh, organic produce in urban spaces,
                    promoting a healthier and more sustainable lifesty</p>
                <h2>Get Involved</h2>
                <p>Whether you're a seasoned gardener or just starting, join us in cultivating a greener, healthier
                    urban environment. Connect with us to learn more about our projects, workshops, and how you can
                    contribute to the urban gardening movement. <br>Thank you for being part of our journey towards a
                    more sustainable and green future!</p>
                <!-- Link to the Contact Us page for user engagement -->
                <a href="./contact.php" class="contact">Contact Us</a>
            </div>
        </section>
    </div>
    <!-- Footer section with a leaf icon and copyright information -->
    <footer>
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>
    </footer>
    <!-- JavaScript script for menu functionality -->
    <script src="./jss/menu.js"></script>
</body>

</html>