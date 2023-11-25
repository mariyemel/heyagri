<?php
// Include necessary files for database connection and configuration
include './connection/db_connection.php';
include('Config.php');

// Get the selected plants from the database
$selection_result = getSelectedPlants();
$selected_plants = array();

// Fetch plant details and create an associative array
while ($row = $selection_result->fetch_assoc()) {
    $selected_plants[] = array(
        'label' => $row['plant_name'],
        'value' => $row['plant_id'],
    );
}
?>
<?php
// Start or resume a session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Set character set and viewport for responsiveness -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>Harvest guide</title>

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Stylesheets for page styling -->
    <link rel="stylesheet" href="./style/styleMultitag.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/harvest.css">
    <link rel="stylesheet" href="./style/menuServices.css">
    <link rel="stylesheet" href="./style/footer.css">

    <!-- Include JavaScript for multiselect tag and other functionalities -->
    <script src="./jss/multitag.js"></script>

</head>

<body>
    <!-- Header section -->
    <header>
        <div class="logo">
            <img src="./img/logo2.png" alt="logo">
        </div>

        <!-- menu responsive -->
        <div class="menu-toggle"></div>

        <!-- Navigation menu -->
        <ul class="menu">
            <li><a href="./home.php">Home</a></li>
            <li><a href="./about.php">About Us</a></li>
            <li><a href="./services.php">Services</a></li>
            <li><a href="./contact.php">Contact</a></li>

            <!-- Display "Déconnexion" (Logout) if a user is logged in, otherwise show "Sign-In" -->
            <?php if (isset($_SESSION['id'])) : ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="sign-in.php">Sign-In</a></li>
            <?php endif; ?>
        </ul>
    </header>

    <!-- Plant selection form -->
    <div class="plant-selection">
        <h3>Selected plants:</h3>
        <!-- Form for selecting multiple plants -->
        <form name="plant_selection" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <select name="plants[]" id="plants" multiple>
                <!-- Populate dropdown with selected plant options -->
                <?php
                foreach ($selected_plants as $plant) {
                    echo "<option value=\"" . htmlspecialchars($plant['value']) . "\">" . htmlspecialchars($plant['label']) . "</option>";
                }
                ?>
            </select>
            <!-- Submit button for plant selection -->
            <input type="submit" name="submit_plants" value="Submit plant selection">
        </form>
    </div>

    <!-- Display details of selected plants -->
    <div class="resultat">
        <?php
        if (isset($_POST['submit_plants'])) {
            $selectedValues = $_POST['plants'];

            // Prepared SQL query to retrieve specific information about selected plants
            $placeholders = implode(',', array_fill(0, count($selectedValues), '?'));
            $sql = "SELECT p.plant_id, plant_name, harvest_ready, harvest_instruct, i.image_url AS harvest_image
            FROM plants p
            LEFT JOIN images i ON p.plant_id = i.plant_id AND i.image_section = 'harvest'
            LEFT JOIN plants_id pid ON p.plant_id = pid.plant_id
            WHERE p.plant_id IN ($placeholders) AND p.plant_id = pid.plant_id";

            // Prepare and execute the SQL statement
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, str_repeat('i', count($selectedValues)), ...$selectedValues);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // Display details of each selected plant
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<h3>Selected plant: " . htmlspecialchars($row['plant_name']) . "</h3>";
                        echo '<div class="text-photo">';
                        echo '<div class="text">';
                        echo "<h4>Harvest Ready</h4>";
                        echo "<p>" . htmlspecialchars($row['harvest_ready']) . "</p>";
                        echo "<h4>Instruction </h4>";
                        echo "<p>" . htmlspecialchars($row['harvest_instruct']) . "</p>";
                        echo '</div>';
                        echo "<img src='" . htmlentities($row['harvest_image'], ENT_QUOTES, 'UTF-8') . "' alt='Image of new seedlings'>";
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

    <!-- Default information sections -->
    <div class="default-info">
        <h2>Harvesting Plants with Precision:</h2>
        <p>
            Harvesting marks the culmination of careful cultivation, where the fruits of labor are gathered at their peak. Timing is
            paramount; each plant has its ideal harvesting moment, ensuring optimal flavor, nutrition, and overall quality. Whether it's
            the vibrant hues of ripe fruits or the crispness of fresh vegetables, a keen eye and gentle touch during harvest guarantee a
            bountiful yield and a gratifying culmination to the gardening journey.
        </p>
        <h2>More Services :</h2>
    </div>

    <!-- Section for displaying other gardening services -->
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

    <!-- Footer section -->
    <footer>
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>
    </footer>

    <!-- Include script for responsive menu -->
    <script src="./jss/menu.js"></script>

    <!-- Initialize the Multiselect Tag functionality -->
    <script>
        new MultiSelectTag('plants', {
            rounded: true,
            shadow: true,
            placeholder: 'Search',
            onChange: function(values) {
                console.log(values)
            }
        })

        // Prevent caching of pages in the browser's history
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>