<?php
// Start or resume the session
session_start();

// Database connection using PDO
$bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', 'root');
$erreur = ''; // Variable to store error messages

// Check if both username and password are provided
if (isset($_POST['send'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['passwd'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = $_POST['passwd'];  // Do not use htmlspecialchars for the password

        // Check if the username already exists
        $checkUser = $bdd->prepare('SELECT id FROM users WHERE pseudo=?');
        $checkUser->execute(array($pseudo));

        if ($checkUser->rowCount() > 0) {
            // If the username is already taken, display an error message

            $erreur = "This username is already taken. Please choose another one..";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user with the hashed password
            $insertUser = $bdd->prepare('INSERT INTO users(pseudo, passwd) VALUES (?, ?)');
            $insertUser->execute(array($pseudo, $hashedPassword));

            // Retrieve the user after insertion
            $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo=?');
            $recupUser->execute(array($pseudo));

            // If the user is successfully retrieved, set session variables
            if ($recupUser->rowCount() > 0) {
                $user = $recupUser->fetch();
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $pseudo;
            }
            echo $_SESSION['id'];
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
    <title>sign-up</title>

    <!-- Stylesheets for page styling -->
    <link rel="stylesheet" href="style/signIn.css">
    <link rel="stylesheet" href="./style/footer.css">

    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Header section with logo and responsive menu -->
    <header>
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
    <!-- Sign-up section -->
    <section class="sign-in">
        <div class="content">
            <h2>Sign-up</h2>
        </div>
        <div class="sign-in-form">
            <!-- Form for user registration -->
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
                <!-- Submit button and link to sign-in page -->
                <input type="submit" name="send">
                <p>If you already have an account, please <a href="sign-in.php"> sign in</a></p>
            </form>
        </div>
    </section>

    <!-- Footer section -->
    <footer>
        <!-- Copyright information with a leaf icon -->
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>
    </footer>

    <!-- Script for menu toggle functionality -->
    <script src="./jss/menu.js"></script>
</body>

</html>