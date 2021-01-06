<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universite";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['user']) && isset($_POST['filiere']) && isset($_POST['cne'])) {

    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);
    $cne = mysqli_real_escape_string($conn, $_POST['cne']);

    $sql = "INSERT INTO etudiant (id_user, id_filiere,cne) VALUES ('$user','$filiere','$cne');";

    $sql_change_type = "UPDATE user SET type=4 WHERE id_user=$user";

    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql_change_type)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
