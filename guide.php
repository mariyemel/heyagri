<?php
// Include necessary files for database connection and configuration
include './connection/db_connection.php';
include('Config.php');

// Start output buffering
ob_start();

// Retrieve selected plants from the database
$selection_result = getSelectedPlants();
$selected_plants = array();


// Fetch selected plants and store in an array
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
    <title>Planting Guide</title>

    <!-- External CSS dependencies -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/styleMultitag.css">
    <link rel="stylesheet" href="./style/guide.css">
    <link rel="stylesheet" href="./style/menuServices.css">
    <link rel="stylesheet" href="./style/footer.css">

    <!-- External JavaScript dependency for multiselect functionality -->
    <script src="./jss/multitag.js"></script>
</head>

<body>
    <!-- Home Section -->
    <section id="container">
        <header>
            <div class="logo">
                <img src="./img/logo2.png" alt="logo">
            </div>
            <!-- menu responsive -->
            <div class="menu-toggle"></div>

            <!-- Navigation Menu -->
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

        <!-- Container Text -->
        <div class="container-text">
            <h1>Planting Guide</h1>
            <p>where each seed holds the promise of a blossoming journey into sustainable gardening practices.</p>
        </div>
    </section>

    <!-- Plant Selection Section -->
    <section>
        <div class="plant-selection">
            <h3>Selected plants:</h3>

            <!-- Form for selecting plants -->
            <form method="post">
                <!-- Multiselect dropdown for plant selection -->
                <select name="plants[]" id="plants" multiple>
                    <!-- Populate with plant options from the database -->
                    <?php
                    // Use $selected_plants for the loop
                    foreach ($selected_plants as $plant) {
                        $isSelected = ($plant['value'] == $selectedPlantId) ? 'selected' : '';
                        echo "<option value=\"" . htmlspecialchars($plant['value']) . "\" $isSelected>" . htmlspecialchars($plant['label']) . "</option>";
                    }
                    ?>
                </select>
                <!-- Submit button for plant selection -->
                <input type="submit" name="submit_plants" value="Submit plant selection">
            </form>
        </div>

        <!-- Result Section -->
        <div class="resultat">
            <?php
            // Process selected plant values
            $selectedValues = isset($_POST['plants']) ? $_POST['plants'] : array();

            if (!empty($selectedValues)) {
                foreach ($selectedValues as $selectedPlantId) {

                    // SQL query to retrieve planting dates for the selected plant
                    $sql = "SELECT p.plant_id, plant_name, date_id, days_difference, days_to_start, days_to_end 
                    FROM planting_dates pd, plants p, plants_id pi 
                    WHERE (p.plant_id = pi.plant_id AND p.plant_id = ? AND pd.plant_id = p.plant_id)";

                    $stmt = mysqli_prepare($conn, $sql);

                    if ($stmt) {

                        // Bind parameters and execute the query
                        mysqli_stmt_bind_param($stmt, 'i', $selectedPlantId);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        $wateringDates = array();

                        // Fill $wateringDates with the results of the query
                        while ($row = mysqli_fetch_assoc($result)) {
                            $wateringDates[] = $row;
                        }

                        // Display the name of the selected plant
                        $plantName = "";
                        if (!empty($wateringDates)) {
                            $plantName = $wateringDates[0]['plant_name'];
                            echo "<h3>Selected Plant: $plantName</h3>";
                        }

                        // Generate the calendar here
                        $currentYear = date('Y');
                        $month = !empty($wateringDates) ? date('m', strtotime($wateringDates[0]['days_to_start'])) : date('m');
                        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $currentYear);
                        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $currentYear);
                        $dayOfWeek = date('w', $firstDayOfMonth);

                        // If the start date is earlier than the current date, add a year
                        if (!empty($wateringDates) && strtotime($wateringDates[0]['days_to_start']) < time()) {
                            $currentYear++; // add a year
                            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $currentYear);
                            $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $currentYear);
                        }

                        // Calendar start
                        echo "<table>";
                        echo "<tr><th colspan='7'>" . date('F Y', $firstDayOfMonth) . "</th></tr>";
                        echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

                        // Initial filling with empty cells
                        echo "<tr>";
                        for ($i = 0; $i < $dayOfWeek; $i++) {
                            echo "<td></td>";
                        }

                        // Fill the calendar with days and mark watering days
                        for ($day = 1, $cellCount = $dayOfWeek; $day <= $daysInMonth; $day++, $cellCount++) {
                            if ($cellCount % 7 == 0) {
                                echo "</tr><tr>"; // New row for each week
                            }

                            // Check if the current day is a watering day
                            $isWateringDay = false;
                            foreach ($wateringDates as $watering) {
                                $wateringDay = date('j', strtotime($watering['days_to_start']));

                                if ($wateringDay == $day) {
                                    $isWateringDay = true;
                                    break;
                                }
                            }

                            $class = $isWateringDay ? 'class="watering-day"' : '';
                            echo "<td $class>$day</td>";
                        }

                        // Final filling with empty cells
                        while ($cellCount % 7 != 0) {
                            echo "<td></td>";
                            $cellCount++;
                        }

                        echo "</tr>";
                        echo "</table>";
                    }
                }
            }
            ?>
        </div>
    </section>

    <!-- Default Information Section -->
    <div class="default-info">

        <h2>Nature's Icy Embrace</h2>
        <p>
            Frost, commonly known as a thin layer of ice that forms on surfaces, occurs when the temperature of air and objects drops
            below freezing. This natural phenomenon can have a significant impact on plants, as ice crystals can form on plant tissues,
            potentially causing damage. Frost is more likely to occur on clear, calm nights when heat radiates from the ground into the
            atmosphere. It's important for gardeners to be aware of frost risk, especially during colder seasons, and take protective
            measures such as covering or bringing sensitive plants indoors to prevent potential harm. Understanding local climate
            patterns and monitoring weather forecasts play a key role in managing the impact of frost on gardens and crops.
        </p>
        <h2>More Services</h2>
    </div>

    <!-- Our Services Section -->
    <section id="our-services">
        <div class="liste-photos">
            <!-- Service Images with Links -->
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


    <!-- scripts JS  -->

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