<?php
// Establish a connection to the database
$bdd = new PDO('mysql:host=localhost;dbname=messages;charset=utf8', 'root', 'root');
$msg = "";

// Check if the form has been submitted
if (isset($_POST['send'])) {

    // Check if the required fields are not empty
    if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['message'])) {

        // Retrieve values from the form and sanitize them
        $fullname = htmlspecialchars($_POST['fullname']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $message = htmlspecialchars($_POST['message']);

        // Prepare the insert query for the 'contacts' table
        $stmt = $bdd->prepare("INSERT INTO contacts (fullname, email, message) VALUES (:fullname, :email, :message)");

        // Bind parameters to the query
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Execute the query
        if ($stmt->execute()) {
            $msg = "Message sent successfully!";
        } else {
            // $stmt->errorInfo() returns an array containing error information
            echo "Error: " . implode(", ", $stmt->errorInfo());
        }

        // The connection is closed automatically when the script ends
    }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/header.css">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./style/contact.css">
    <link rel="stylesheet" href="./style/footer.css">
</head>

<body>

    <!-- Header Section -->
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

    <section class="contact">
        <div class="content">
            <h2>Contact Us</h2>
        </div>

        <div class="container">

            <!-- Contact Information -->
            <div class="contact-info">
                <div class="box">
                    <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>heyagri@gmail.com</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>phone number</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-github" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>GitHub</h3>
                        <p>code on github</p>
                    </div>
                </div>
            </div>
            <!-- Contact Form -->
            <div class="contact-form">
                <form method="POST" action="">
                    <h2>Send Message</h2>

                    <!-- Full Name Input -->
                    <div class="inputBox">
                        <input type="text" name="fullname" required="required" autocomplete="off">
                        <span>Full Name</span>
                    </div>

                    <!-- Email Input -->
                    <div class="inputBox">
                        <input type="text" name="email" required="required" autocomplete="off">
                        <span>Email</span>
                    </div>

                    <!-- Message Textarea -->
                    <div class="inputBox">
                        <textarea name="message" required="required" autocomplete="off"></textarea>
                        <span>Message</span>
                    </div>

                    <?php
                    echo  '<p>' . $msg . '</p>';
                    ?>

                    <!-- Submit Button -->
                    <div class="inputBox">
                        <input type="submit" name="send" value="send">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>
    </footer>

    <!-- JavaScript for Responsive Menu -->
    <script src="./jss/menu.js"></script>
</body>

</html>