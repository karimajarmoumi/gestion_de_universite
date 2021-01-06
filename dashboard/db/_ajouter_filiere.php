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

if (isset($_POST['nom']) && isset($_POST['departement'])) {

    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $departement = mysqli_real_escape_string($conn, $_POST['departement']);

    $sql = "INSERT INTO filiere (nom, id_departement) VALUES ('$nom','$departement');";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
