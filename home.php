<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/96dcb489df.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/home_style.css">
    <link rel="stylesheet" href="./style/footer.css">
</head>

<body>
    <!--section Home-->
    <section id="container">
        <header>
            <div class="logo">
                <img src="./img/logo2.png" alt="logo">
            </div>
            <!-- menu responsive -->
            <div class="menu-toggle"></div>

            <ul class="menu">
                <li><a href=".">Home</a></li>
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
        <div class="container-text">
            <h1>Where Seeds Blossom, Dreams Grow</h1>
            <p>Our mission is to foster sustainable gardening practices, nurturing nature's wonders for generations to
                come.</p>
            <?php if (isset($_SESSION['id'])) : ?>
                <a href="services.php">Our Services</a>
            <?php else : ?>
                <a href="sign-in.php">Sign-In</a>
            <?php endif; ?>
        </div>
    </section>
    <!-- section about us-->
    <section id="about-us">
        <div>
            <p class="tittle-section"> About Us</p>
            <div class="text-photo">
                <div class="text">
                    <p>At HeyAgri, our passionate team blends sustainable gardening with modern technologies to create
                        efficient urban vegetable gardens. We optimize the use of limited spaces by carefully planning
                        gardens, selecting crops suitable for the local climate, and integrating smart technologies.
                        Join us on this journey towards a greener urban lifestyle. To learn more about us, check out our
                        dedicated page.</p>
                    <button class="button-link">
                        <a href="./about.php">See More</a>
                    </button>
                </div>
                <img src="./img/pots2.jpg" alt="">
            </div>
        </div>
    </section>
    <!--section services-->
    <section id="our-services">
        <p class="tittle-section">Services</p>
        <div class="liste-photos">
            <div class="service-img">
                <img src="./img/pots1.jpg" alt="">
                <div class="show-service">
                    <p>planting</p>
                </div>
            </div>
            <div class="service-img">
                <img src="./img/arrosage1.jpg" alt="">
                <div class="show-service">
                    <p>Watering</p>
                </div>
            </div>
            <div class="service-img">
                <img src="./img/care2.jpg" alt="">
                <div class="show-service">
                    <p>Care</p>
                </div>
            </div>
            <div class="service-img">
                <img src="./img/carotte1.jpg" alt="">
                <div class="show-service">
                    <p>Harvest</p>
                </div>
            </div>
        </div>
    </section>
    <!--section contact-->
    <section id="contact">
        <p class="tittle-section">Contact Us</p>
        <div class="text-photo">
            <div class="text">
                <p>Don't hesitate to reach out to us for any questions or service requests. <br><br> You can also send
                    your recommendations and complaints to our email address, heyagri@gmail.com. <br> <br> Explore our
                    dedicated contact information page for more details.</p>
                <button class="button-link">
                    <a href="./contact.php">Contact Us</a>
                </button>
            </div>

            <img src="./img/contact.jpg" alt="" class="img">
        </div>
    </section>
    <!-- footer -->
    <footer>
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>

    </footer>
    <script src="./jss/menu.js"></script>
</body>


</html>