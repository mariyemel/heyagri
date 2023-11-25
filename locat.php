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
    <title>Location Guide</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./style/styleMultitag.css">
    <link rel="stylesheet" href="./style/header.css">
    <link rel="stylesheet" href="./style/location.css">
    <link rel="stylesheet" href="./style/menuServices.css">
    <link rel="stylesheet" href="./style/footer.css">
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
            <li><a href="./services.php">Services</a>
            <li><a href="./contact.php">Contact</a></li>
            <?php if (isset($_SESSION['id'])) : ?>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="sign-in.php">Sign-In</a></li>
            <?php endif; ?>
        </ul>
    </header>

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

    <div class="resultat">
        <?php
        if (isset($_POST['submit_plants'])) {
            $selectedValues = isset($_POST['plants']) ? $_POST['plants'] : array();

            if (!empty($selectedValues)) {
                // La requête préparée commence ici
                $placeholders = implode(',', array_fill(0, count($selectedValues), '?'));
                $sql = "SELECT p.plant_id, plant_name, soil_requirements, shade_requirements, spacing, plant_id_secondary, friendless
                FROM plants p, plants_id pi, plant_relationship pr
                WHERE (p.plant_id = pi.plant_id AND p.plant_id IN ($placeholders) AND pi.plant_id = pr.plant_id_main)";

                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, str_repeat('i', count($selectedValues)), ...$selectedValues);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    $plantsData = array();

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $plantId = $row['plant_id'];
                            $secondaryId = $row['plant_id_secondary'];

                            // Ajout des détails de la plante principale
                            if (!isset($plantsData[$plantId])) {
                                $plantsData[$plantId] = array(
                                    'name' => htmlspecialchars($row['plant_name']),
                                    'soil_requirements' => htmlspecialchars($row['soil_requirements']),
                                    'shade_requirements' => htmlspecialchars($row['shade_requirements']),
                                    'spacing' => htmlspecialchars($row['spacing']),
                                    'nearPlants' => array(),
                                    'awayPlants' => array(),
                                );
                            }

                            // Ajout des relations "Near To" et "Away From"
                            $plantType = ($row['friendless'] == 'Near') ? 'nearPlants' : 'awayPlants';
                            $plantsData[$plantId][$plantType][$secondaryId] = '';
                        }

                        // Affichage des détails pour chaque plante
                        foreach ($plantsData as $plantId => $plantDetails) {
                            echo "<h3>Selected plant: " . $plantDetails['name'] . "</h3>";
                            echo "<h4>Soil Requirements:</h4>";
                            echo "<p>" . $plantDetails['soil_requirements'] . "</p>";
                            echo "<h4>Shade Requirements:</h4>";
                            echo "<p>" . $plantDetails['shade_requirements'] . "</p>";
                            echo "<h4>Spacing:</h4>";
                            echo "<p>Spacing: " . $plantDetails['spacing'] . "</p>";

                            // Affichage des plantes "Near To"
                            if (!empty($plantDetails['nearPlants'])) {
                                echo "<h4>Plants Near To:</h4>";
                                foreach ($plantDetails['nearPlants'] as $id => $name) {
                                    $plantNameQuery = "SELECT plant_name FROM plants_id WHERE plant_id = $id";
                                    $plantNameResult = mysqli_query($conn, $plantNameQuery);

                                    if ($plantNameResult && mysqli_num_rows($plantNameResult) > 0) {
                                        $plantNameRow = mysqli_fetch_assoc($plantNameResult);
                                        $plantName = htmlspecialchars($plantNameRow['plant_name']);
                                        echo "<p>" . $plantName . "</p>";
                                    }
                                }
                            }

                            // Affichage des plantes "Away From"
                            if (!empty($plantDetails['awayPlants'])) {
                                echo "<h4>Plants Away From:</h4>";
                                foreach ($plantDetails['awayPlants'] as $id => $name) {
                                    $plantNameQuery = "SELECT plant_name FROM plants_id WHERE plant_id = $id";
                                    $plantNameResult = mysqli_query($conn, $plantNameQuery);

                                    if ($plantNameResult && mysqli_num_rows($plantNameResult) > 0) {
                                        $plantNameRow = mysqli_fetch_assoc($plantNameResult);
                                        $plantName = htmlspecialchars($plantNameRow['plant_name']);
                                        echo "<p>" . $plantName . "</p>";
                                    }
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



    <div class="default-info">

        <h2>Crop Rotation</h2>
        <h3>Purpose and Benefits</h3>
        <p>
            Crop rotation involves planting a different crop in the same location each season. This practice disrupts the accumulation of diseases and pests in the soil, as many of them are specialized for specific plant families. Another way in which crop rotation enhances soil health is through the varied root structures of different plants, contributing to improved soil composition. Additionally, it facilitates nutrient regeneration, as different plants have distinct nutrient requirements, and some can even replenish specific nutrients. While crop rotation is generally beneficial, there exists a specific recommended order for rotating major plant families. This order is especially valuable as it addresses the diverse needs and vulnerabilities of each plant family.
        </p>
        <h3>Recommended Rotation Order</h3>
        <ul>
            <li>Alliums</li>
            <li>Legumes</li>
            <li>Brassicas</li>
            <li>Nightshades</li>
            <li>Umbellifers</li>
            <li>Cucurbits</li>
        </ul>
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
    <footer>
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>

    </footer>
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