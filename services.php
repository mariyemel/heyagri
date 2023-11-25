<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: sign-in.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/services.css">
    <link rel="stylesheet" href="./style/footer.css">
</head>

<body>
    <!--section header-->
    <section id="container">
        <header>
            <div class="logo">
                <img src="./img/logo2.png" alt="logo">
            </div>
            <!-- menu responsive -->
            <div class="menu-toggle"></div>

            <ul class="menu">
                <li><a href="./home.php">Home</a></li>
                <li><a href="./about.php">About Us</a></li>
                <li><a href="#">Services</a></li> <!-- Ajout de la balise fermante li -->
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="./logout.php">Déconnexion</a></li>
            </ul>
        </header>
        <div class="container-text">
            <p>Welcome to HeyAgri, where we offer a comprehensive range of services to optimize the management of your
                urban vegetable garden. Explore how we can help you grow high-quality vegetables efficiently and
                sustainably.</p>

        </div>
    </section>

    <!--section header-->
    <section id="services">
        <h1 class="title">Services</h1>
        <div class="list-services">
            <div class="left">
                <h1>1</h1>
                <div class="description">
                    <h3>Planting Guide</h3>
                    <p>Choose the perfect spot for your garden with our Location Selection service. we will guide you in
                        identifying the optimal location based on space considerations. Additionally, access our
                        Planting Guide for step-by-step instructions on planting your chosen vegetables, ensuring a
                        successful start for your urban garden.</p>
                </div>
            </div>
            <div class="right">
                <a href="./choix.php">
                    <img src="./img/pots1.jpg" alt="">
                    <div class="show-service">
                        <p>Planting</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="list-services">
            <div class="left">
                <h1>2</h1>
                <div class="description">
                    <h3>Watering Guide</h3>
                    <p>Maintain the health and vitality of your plants with our Watering Guide. Learn the art of proper
                        watering techniques to keep your garden thriving. From establishing the right watering schedule
                        to understanding the water needs of different plants, we've got you covered. Ensure your garden
                        receives the hydration it deserves for robust growth.</p>
                </div>
            </div>
            <div class="right">
                <a href="./watering.php">
                    <img src="./img/arrosage1.jpg" alt="">
                    <div class="show-service">
                        <p>Watering</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="list-services">
            <div class="left">
                <h1>3</h1>
                <div class="description">
                    <h3>Plant Care</h3>
                    <p>Nurture your garden with our Plant Care service. Explore essential tips and practices to ensure
                        your plants are in top condition. From pest management to fertilization, our guidance will
                        empower you to create a thriving ecosystem in your urban oasis. Elevate your plant care skills
                        with HeyAgri.</p>
                </div>
            </div>
            <div class="right">
                <a href="care.php">
                    <img src="./img/pots1.jpg" alt="">
                    <div class="show-service">
                        <p>Care</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="list-services">
            <div class="left">
                <h1>4</h1>
                <div class="description">
                    <h3>Harvest Instructions</h3>
                    <p>Harvesting your homegrown produce is a rewarding experience. Our Harvest Instruction service
                        provides valuable insights into the best time to harvest each crop, proper harvesting
                        techniques, and tips for preserving freshness. Enjoy the fruits of your labor with confidence,
                        knowing you've harvested your vegetables at their peak.</p>
                </div>
            </div>
            <div class="right">
                <a href="./harvest.php">
                    <img src="./img/carotte1.jpg" alt="">
                    <div class="show-service">
                        <p>Harvest</p>
                    </div>
                </a>
            </div>
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