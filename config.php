<?php
// Database connection information
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'heyagri');

// Establish a connection to the MySQL database 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if ($conn === false) {
    // Display an error message and terminate the script if the connection fails
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
