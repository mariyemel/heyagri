<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=users;charset=utf8', 'root', 'root');
$erreur = '';

if (isset($_POST['send'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['passwd'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = $_POST['passwd'];  // Ne pas utiliser htmlspecialchars pour le mot de passe

        // Vérifier si le pseudo existe déjà
        $checkUser = $bdd->prepare('SELECT id FROM users WHERE pseudo=?');
        $checkUser->execute(array($pseudo));

        if ($checkUser->rowCount() > 0) {
            $erreur = "Ce nom d'utilisateur est déjà pris. Veuillez choisir un autre.";
        } else {
            // Hacher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insérer l'utilisateur avec le mot de passe haché
            $insertUser = $bdd->prepare('INSERT INTO users(pseudo, passwd) VALUES (?, ?)');
            $insertUser->execute(array($pseudo, $hashedPassword));

            // Récupérer l'utilisateur après l'insertion
            $recupUser = $bdd->prepare('SELECT * FROM users WHERE pseudo=?');
            $recupUser->execute(array($pseudo));

            if ($recupUser->rowCount() > 0) {
                $user = $recupUser->fetch();
                $_SESSION['id'] = $user['id'];
                $_SESSION['pseudo'] = $pseudo;
            }
            echo $_SESSION['id'];
        }
    } else {
        $erreur = "Veuillez saisir toutes les informations.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/signIn.css">
    <link rel="stylesheet" href="./style/footer.css">
    <title>sign-up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
        </ul>
    </header>
    <section class="sign-in">
        <div class="content">
            <h2>Sign-up</h2>
        </div>
        <div class="sign-in-form">
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
                echo  '<p>' . $erreur . '</p>';
                ?>
                <input type="submit" name="send">
                <p>If you already have an account, please <a href="sign-in.php"> sign in</a></p>
            </form>
        </div>

    </section>
    <!-- footer -->
    <footer>
        <div>
            <i class="fa fa-leaf" aria-hidden="true"></i>
            <p>Copyright HeyAgri</p>
        </div>

    </footer>
    <script src="./jss/menu.js"></script>
</body>

</html>