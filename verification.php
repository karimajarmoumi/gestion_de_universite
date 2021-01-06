<?php
session_start();


$user = isset($_SESSION['user']) ? $_SESSION['user'] : '';

if ($user == '') {
    header('Location: login.php');
    exit();
} else if (getTypeUser()) {

    if ($_SESSION['user']['type'] != 0) {
        header('Location: dashboard');
        exit();
    }
}


function getTypeUser()
{
    require 'database/connexion.php';
    $sql = "SELECT type FROM user WHERE id_user=" . $_SESSION['user']['id_user'];

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user']['type'] = $row['type'];

        return true;
    }
    return false;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Verification de compte</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- Add Jquery -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>

</head>

<body class="text-center">

    <div class="form-signin alert alert-info">

        <img class="mb-4" src="assets/images/logo.jpg" alt="" width="120" height="120">

        <p class="text-justify" style="color:black;">

            Bonjour <strong><?php echo $user['nom'] . " " . $user['prenom'] ?></strong>,
            <br>
            Votre compte a été créé avec succès, vos informations seront vérifiées par l'université.
        </p>

        <strong>Vous pouvez essayer de se connecter plus tard, Merci.</strong>
        <br>
        <a href="logout.php">Déconnexion</a>

    </div>

</body>

</html>