<?php
include './connection/db_connection.php';
include('Config.php');
// Obtenez les plantes sélectionnées
$selection_result = getSelectedPlants();
$selected_plants = array();

while ($row = $selection_result->fetch_assoc()) {
    $selected_plants[] = array(
        'label' => $row['plant_name'],
        'value' => $row['plant_id'],
    );
}
?>
<?php
// Start a new session or resume an existing session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watering Guide</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/wat.css">
    <link rel="stylesheet" href="./style/menuServices.css">
    <link rel="stylesheet" href="./style/footer.css">
    <link rel="stylesheet" href="./style/styleMultitag.css">

    <script src="./jss/multitag.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="./img/logo2.png" alt="logo">
        </div>
        <!-- menu responsive -->
        <div class="menu-toggle"></div>

        <ul class="menu">
            <li><a href="./home.php">Home</a></li>
            <li><a href="./about.php">About Us</a></li>
            <li><a href="./services.php">Services</a></li>
            <li><a href="./contact.php">Contact</a></li>
            <?php if (isset($_SESSION['id'])) : ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="sign-in.php">Sign-In</a></li>
            <?php endif; ?>
        </ul>
    </header>
    <div class="plant-selection">
        <h3>Selecte plants:</h3>
        <form name="plant_selection" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <select name="plants[]" id="plants" multiple>
                <?php
                foreach ($selected_plants as $plant) {
                    echo "<option value=\"" . htmlspecialchars($plant['value']) . "\">" . htmlspecialchars($plant['label']) . "</option>";
                }
                ?>
            </select>
            <input type="submit" name="submit_plants" value="Submit plant selection">
        </form>
    </div>

    <div class="resultat">
        <?php

        if (isset($_POST['submit_plants'])) {
            $selectedValues = $_POST['plants'];

            $placeholders = implode(',', array_fill(0, count($selectedValues), '?'));
            $sql = "SELECT p.plant_id, plant_name, watering_baby, watering_adulte, i.image_url AS baby_image, i2.image_url AS adult_image
            FROM plants p
            LEFT JOIN images i ON p.plant_id = i.plant_id AND i.image_section = 'baby'
            LEFT JOIN images i2 ON p.plant_id = i2.plant_id AND i2.image_section = 'adulte'
            LEFT JOIN plants_id pid ON p.plant_id = pid.plant_id
            WHERE (p.plant_id IN ($placeholders) and p.plant_id = pid.plant_id)";


            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, str_repeat('i', count($selectedValues)), ...$selectedValues);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                //eviter SQL injection
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<h3>Selected plant: " . htmlentities($row['plant_name'], ENT_QUOTES, 'UTF-8') . "</h3>";
                        echo '<div class="text-photo">';
                        echo '<div class="text">';
                        echo "<h4>Watering new seedlings</h4>";
                        echo "<p>" . htmlentities($row['watering_baby'], ENT_QUOTES, 'UTF-8') . "</p>";
                        echo '</div>';
                        echo "<img src='" . htmlentities($row['baby_image'], ENT_QUOTES, 'UTF-8') . "' alt='Image of new seedlings'>";
                        echo '</div>';
                        echo '<div class="text-photo">';
                        echo '<div class="text">';
                        echo "<h4>Watering older plants</h4>";
                        echo "<p>Watering Adult: " . htmlentities($row['watering_adulte'], ENT_QUOTES, 'UTF-8') . "</p>";
                        echo '</div>';
                        echo "<img src='" . htmlentities($row['adult_image'], ENT_QUOTES, 'UTF-8') . "' alt='Adult Image'>";
                        echo '</div>';
                    }
                } else {
                    echo "<p>No plants were selected or no matching plants found.</p>";
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "<p>Error preparing statement: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
            }
        }
        ?>
    </div>
    <div class="default-info">

        <h2>General watering tips</h2>
        <p>
            Efficient plant watering involves directing water at the base to prevent leaf-related diseases like powdery mildew.
            Morning watering is ideal, allowing soil absorption before midday sun. For many plants, infrequent deep watering promotes
            robust root development. Potted plants need more frequent watering due to limited soil. Use ambient temperature water to
            avoid shocking or burning the plant. Mulching aids soil water retention, reducing the need for frequent watering. Focus on
            one spot for extended watering, ensuring deep root saturation for sustained plant hydration.
        </p>
        <h2>More Services :</h2>
    </div>
    <section id="our-services">
        <div class="liste-photos">
            <div class="service-img">
                <a href="choix.php">
                    <img src="./img/pots1.jpg" alt="">
                    <div class="show-service">
                        <p>planting</p>

                    </div>
                </a>
            </div>
            <div class="service-img">
                <a href="watering.php">
                    <img src="./img/arrosage1.jpg" alt="">
                    <div class="show-service">
                        <p>Watering</p>

                    </div>
                </a>
            </div>
            <div class="service-img">
                <a href="care.php">
                    <img src="./img/care2.jpg" alt="">
                    <div class="show-service">
                        <p>Care</p>

                    </div>
                </a>
            </div>
            <div class="service-img">
                <a href="harvest.php">
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
    <script>
        new MultiSelectTag('plants', {
            rounded: true,
            shadow: true,
            placeholder: 'Search',
            onChange: function(values) {
                console.log(values)
            }
        })
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>