<?php
// Database connection information
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'messages');

// Try to establish a connection to the database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if the connection was successful
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
