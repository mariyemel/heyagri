<?php
// Start or resume the session
session_start();

// Database connection using PDO
$bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', 'root');
$erreur = ''; // Variable to store error messages

// Check if the form is submitted
if (isset($_POST['send'])) {
    // Check if both username and password are provided
    if (!empty($_POST['pseudo']) && !empty($_POST['passwd'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = $_POST['passwd'];  // Do not use htmlspecialchars for the password

        // Retrieve user information based on provided username
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo=?');
        $recupUser->execute(array($pseudo));

        // Check if user exists
        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();
            $hashedPassword = $user['passwd'];

            // Verify the hashed password
            if (password_verify($password, $hashedPassword)) {
                // Set session variables and redirect to services.php
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $pseudo;

                header("Location: services.php");
                exit(); // Make sure to exit the script after redirection
            } else {
                $erreur = "Incorrect password";
            }
        } else {
            $erreur = "User not found";
        }
    } else {
        $erreur = "Please enter all information.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>sign-in</title>

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Stylesheets for page styling -->
    <link rel="stylesheet" href="style/signIn.css">
    <link rel="stylesheet" href="./style/footer.css">

</head>

<body>
    <header>
        <!-- Header section with logo and responsive menu -->
        <div class="logo">
            <img src="./img/logo2.png" alt="logo">
        </div>
        <!-- menu responsive -->
        <div class="menu-toggle"></div>

        <!-- Navigation menu with links -->
        <ul class="menu">
            <li><a href="./home.php">Home</a></li>
            <li><a href="./about.php">About Us</a></li>
            <li><a href="./services.php">Services</a>
            <li><a href="./contact.php">Contact</a></li>
        </ul>
    </header>

    <!-- Sign-in section -->
    <section class="sign-in">
        <div class="content">
            <h2>Sign-in</h2>
        </div>
        <div class="sign-in-form">
            <!-- Form for user login -->
            <form method="POST" action="">
                <div class="inputBox">
                    <input type="text" name="pseudo" autocomplete="off">
                    <span>Full Name</span>
                </div>
                <div class="inputBox">
                    <input type="password" name="passwd" autocomplete="off">
                    <span>Password</span>
                </div>
                <?php
                // Display error message if any
                echo  '<p>' . $erreur . '</p>';
                ?>
                <!-- Submit button and link to sign-up page -->
                <input type="submit" name="send">
                <p>If you don't have an account, please <a href="sign-up.php"> sign up</a></p>
            </form>
        </div>
    </section>

    <!-- Footer section -->
    <footer>
        <div>
            <!-- Copyright information with a leaf icon -->
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>

    </footer>

    <!-- Script for menu toggle functionality -->
    <script src="./jss/menu.js"></script>

    <!-- Script to prevent form resubmission on page refresh -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>