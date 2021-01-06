<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// 

if (isset($_GET["editEcoleID"])) edit($_GET["editEcoleID"]);
if (isset($_GET["removeEcoleID"])) remove($_GET["removeEcoleID"]);


function remove($id)
{

    global $conn;

    $sql = "DELETE FROM ecole WHERE id_ecole=$id";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}

function edit($id)
{
    global $conn;

    $sql = "SELECT * FROM ecole WHERE id_ecole=$id";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $html = '<form method="post">
                    <div class="form-group">
                        <label for="id_ecole">ID</label>
                        <input type="text" class="form-control" name="id_ecole"  value="' . $row["id_ecole"] . '" disabled>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="nom"  value="' . $row["nom"] . '" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Email<span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="email" value="' . $row["email"] . '" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Téléphone</label>
                        <input type="text" class="form-control" name="telephone" value="' . $row["telephone"] . '" >
                    </div>
                    <div class="form-group">
                        <label for="nom">Adresse</label>
                        <input type="text" class="form-control" name="adresse" value="' . $row["adresse"] . '" >
                    </div>
                    <div class="form-group">
                        <label for="nom">Date de création</label>
                        <input type="text" class="form-control" name="date" value="' . $row["date"] . '"  disabled>
                    </div>
                        
                </form>';
        echo  $html;
    } else {
        echo '<h3>Aucun résultat</h3>';
    }
}



if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['adresse']) && isset($_POST['id_ecole'])) {

    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $id_ecole = mysqli_real_escape_string($conn, $_POST['id_ecole']);


    $sql = "UPDATE ecole SET nom='$nom', email='$email', telephone='$telephone', adresse='$adresse' WHERE id_ecole='$id_ecole'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
