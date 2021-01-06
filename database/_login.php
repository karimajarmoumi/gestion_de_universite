<?php
session_start();
require 'connexion.php';
?>

<?php
$email = $_POST['email'];
$password = $_POST['password'];
if (isset($email) && isset($password)) {

    $password = md5($password);


    $sql = "SELECT id_user,nom,prenom,email,type FROM user WHERE email='$email' AND password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row;


        header("Location: ../verification.php");
        exit();
    } else {
        header("Location: ../login.php");
        exit();
    }
}
