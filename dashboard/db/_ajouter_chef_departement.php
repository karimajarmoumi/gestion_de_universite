<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universite";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['user']) && isset($_POST['departement'])) {

    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $departement = mysqli_real_escape_string($conn, $_POST['departement']);

    $sql = "INSERT INTO chef_departement (id_departement, id_user) VALUES ('$departement','$user')";
    $sql_change_type = "UPDATE user SET type=2 WHERE id_user=$user";
    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql_change_type)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
