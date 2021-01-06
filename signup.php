<?php
session_start();

$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';

if ($user != '') {
    header('Location: verification.php');
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion | Platform gestion de universite</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- Add Jquery -->
    <script src="assets/js/jquery-3.5.1.min.js" defer></script>



</head>

<body class="text-center">
    <form class="form-signin" action="database/_signup.php" method="post">
        <img class="mb-4" src="assets/images/logo.jpg" alt="" width="120" height="120">
        <h1 class="h3 mb-3 font-weight-normal">Créer un compte</h1>
        <label for="prenom" class="sr-only">Prénom</label>
        <input type="text" id="prenom" class="form-control" name="prenom" placeholder="Prénom" required autofocus>
        <label for="nom" class="sr-only">Nom</label>
        <input type="text" id="nom" class="form-control" placeholder="Nom" name="nom" required>
        <label for="inputEmail" class="sr-only">Email addresse</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign up</button>
        <div class="mt-3">
            <a href="login.php">Se connecter à un compte existant</a>
        </div>
        <p class="mt-2 mb-3 text-muted">&copy; <?php echo date("Y") ?></p>
        <div class="alert alert-primary" role="alert">
            Créé par Karima&nbsp;Jarmoumi et Safaa&nbsp;Khadda.
        </div>
    </form>


    <script>

    </script>

</body>

</html>