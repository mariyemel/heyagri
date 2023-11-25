<?php
session_start();
?>
<?php
// Include necessary files for database connection and configuration
include './connection/db_connection.php';
include('Config.php');

// Get selected plants from the database
$selection_result = getSelectedPlants();
$selected_plants = array();

while ($row = $selection_result->fetch_assoc()) {
    $selected_plants[] = array(
        'label' => $row['plant_name'],
        'value' => $row['plant_id'],
    );
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Care</title>

    <!-- External stylesheets, including Font Awesome icons and custom styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/styleMultitag.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/care.css">
    <link rel="stylesheet" href="./style/footer.css">
    <link rel="stylesheet" href="./style/menuServices.css">

    <!-- JavaScript file for multiselect tag functionality -->
    <script src="./jss/multitag.js"></script>
</head>

<body>
    <header>
        <!-- Header section, including logo, responsive menu toggle, and navigation links -->
        <div class="logo">
            <img src="./img/logo2.png" alt="logo">
        </div>
        <!-- menu responsive -->
        <div class="menu-toggle"></div>

        <!-- Navigation links with conditional options based on user session -->
        <ul class="menu">
            <li><a href="./home.php">Home</a></li>
            <li><a href="./about.php">About Us</a></li>
            <li><a href="./services.php">Services</a></li>
            <li><a href="./contact.php">Contact</a></li>

            <!-- Display "Déconnexion" or "Sign-In" based on user session -->
            <?php if (isset($_SESSION['id'])) : ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="sign-in.php">Sign-In</a></li>
            <?php endif; ?>

        </ul>
    </header>

    <!-- Section for displaying selected plants in a dropdown -->
    <div class="plant-selection">
        <h3>Selected plants:</h3>
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

    <!-- Section for displaying information based on plant selection -->
    <div class="resultat">
        <?php
        if (isset($_POST['submit_plants'])) {
            $selectedValues = isset($_POST['plants']) ? $_POST['plants'] : array();

            if (!empty($selectedValues)) {
                // Prepared query starts 
                $placeholders = implode(',', array_fill(0, count($selectedValues), '?'));
                $sql = "SELECT p.plant_id, plant_name, fertilization, pruning,pp.pest_id, pest_name, pest_description
                FROM plants p, plants_id pid, pest_diseases pd, plant_pest pp 
                WHERE (p.plant_id=pid.plant_id and pp.plant_id=p.plant_id and pp.pest_id=pd.pest_id and p.plant_id IN ($placeholders))";

                // Check if the statement is prepared successfully
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, str_repeat('i', count($selectedValues)), ...$selectedValues);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    $plantsData = array();

                    // Check if there are matching rows in the result
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $plantId = $row['plant_id'];
                            $pestId = $row['pest_id'];

                            // Loop through the result to gather plant and pest details
                            if (!isset($plantsData[$plantId])) {
                                $plantsData[$plantId] = array(
                                    'name' => htmlspecialchars($row['plant_name']),
                                    'fertilization' => htmlspecialchars($row['fertilization']),
                                    'pruning' => htmlspecialchars($row['pruning']),
                                    'pests' => array(),  //Add an array for pests

                                );
                            }

                            // Add details for the pest
                            $plantsData[$plantId]['pests'][] = array(
                                'pest_name' => htmlspecialchars($row['pest_name']),
                                'pest_description' => htmlspecialchars($row['pest_description']),
                            );
                        }

                        // Display details for each selected plant
                        foreach ($plantsData as $plantId => $plantDetails) {
                            echo "<h3>Selected plant: " . $plantDetails['name'] . "</h3>";
                            echo "<h4>fertilization:</h4>";
                            echo "<p>" . $plantDetails['fertilization'] . "</p>";
                            echo "<h4>pruning:</h4>";
                            echo "<p>" . $plantDetails['pruning'] . "</p>";

                            // Display details for each selected plant
                            if (!empty($plantDetails['pests'])) {
                                echo "<h4>Pests:</h4>";
                                foreach ($plantDetails['pests'] as $pest) {
                                    echo "<p><b> " . htmlspecialchars($pest['pest_name']) . ": </b>" . htmlspecialchars($pest['pest_description']) . "</p>";
                                }
                            }
                        }
                    } else {
                        echo "<p>No matching plants found.</p>";
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "<p>Error preparing statement: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
                }
            } else {
                echo "<p>No plants were selected.</p>";
            }
        }
        ?>
    </div>

    <!-- Default information section with tips on repotting -->
    <div class="default-info">
        <h2>Fear Not Repotting</h2>
        <p>
            Contrary to common belief, "repotting" doesn't always mean changing your plant's container. Instead, it involves refreshing
            the soil with a new potting mix to supply essential nutrients. Plants typically benefit from repotting every 12 to 18 months,
            depending on their growth rate. If your plant has outgrown its current container, consider sizing up to a planter only 1 to 3
            inches larger. This ensures your plant has room to grow without drowning in excess soil, preventing overwatering. Embrace
            repotting as a chance to nurture your plant's health and vitality.
        </p>
        <h2>More Services</h2>
    </div>
    <!-- Section displaying additional services with images -->
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

    <footer>
        <!-- Footer section with a leaf icon and copyright information -->
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>
    </footer>

    <!-- JavaScript for initializing the multiselect tag and preventing form resubmission -->
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
    <script src="./jss/menu.js"></script>
</body>

</html>