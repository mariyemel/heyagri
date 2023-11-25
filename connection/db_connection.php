<?php
require_once 'pwd.php';

function getSelectedPlants()
{
    $conn = new mysqli('localhost', USERNAME, PASSWORD, DB);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $selection_sql = "SELECT p.plant_id, p.plant_name
                      FROM plants_id p
                      WHERE p.plant_id IN (2, 3, 4, 5, 17, 33, 42, 43, 49, 51)";

    $selection_result = $conn->query($selection_sql);

    if (!$selection_result) {
        die("Selection failed: " . $conn->error);
    }

    $conn->close();

    return $selection_result;
}
