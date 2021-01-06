<?php
require 'connexion.php';
?>


<?php
$prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
$nom = mysqli_real_escape_string($conn, $_POST['nom']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (isset($prenom) && isset($nom) && isset($email) && isset($password)) {

    $password = md5($password);

    $sql = "INSERT INTO user (nom,prenom,email,password,type) VALUES ('$nom','$prenom', '$email','$password', 0);";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../login.php");
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}
