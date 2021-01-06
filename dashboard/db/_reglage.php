<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$valid_extensions = array('jpeg', 'jpg', 'png');

$path = '../img/user/';

if (isset($_POST['nom']) && isset($_POST['prenom']) && $_FILES['image']) {


    if ($_FILES['image']['name'] != '') {
        $img = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

        $length = 12;
        $today = date("m.d.y");
        $time = substr(hash('md5', $today), 0, $length);


        if (in_array($ext, $valid_extensions)) {
            $final_image = rand(1000, 1000000) . $time . '.' . $ext;
            $path = $path . strtolower($final_image);

            if (move_uploaded_file($tmp, $path)) {

                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $id_user = $_SESSION['user']['id_user'];

                if (empty($_POST['password'])) {
                    $sql = "UPDATE user SET nom='$nom', prenom='$prenom', photo='$final_image' WHERE id_user=$id_user";
                } else {

                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                    $password = md5($password);
                    $sql = "UPDATE user SET nom='$nom', prenom='$prenom', password='$password', photo='$final_image' WHERE id_user=$id_user";
                }
                mysqli_query($conn, $sql);
                echo true;
            }
        } else {
            echo false;
        }
    } else {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $id_user = $_SESSION['user']['id_user'];
        if (empty($_POST['password'])) {
            $sql = "UPDATE user SET nom='$nom', prenom='$prenom'  WHERE id_user=$id_user";

            if (mysqli_query($conn, $sql)) {
                echo true;
            } else {
                echo false;
            }
        } else {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = md5($password);
            $sql = "UPDATE user SET nom='$nom', prenom='$prenom', password='$password'  WHERE id_user=$id_user";

            if (mysqli_query($conn, $sql)) {
                echo true;
            } else {
                echo false;
            }
        }
    }
}
