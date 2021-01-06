<?php

// Check connection


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['adresse'])) {

    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);


    $sql = "INSERT INTO ecole (nom,email,telephone,adresse) VALUES ('$nom','$email', '$telephone','$adresse');";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
