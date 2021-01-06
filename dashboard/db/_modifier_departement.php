<?php

require_once('_select.php');



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}



if (isset($_GET["editDepartementID"])) edit($_GET["editDepartementID"]);
if (isset($_GET["removeDepartementID"])) remove($_GET["removeDepartementID"]);


function remove($id)
{

    global $conn;

    $sql = "DELETE FROM departement WHERE id_departement=$id";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}

function edit($id)
{
    global $conn;

    $sql = "SELECT departement.id_departement, departement.nom as nom_departement, departement.date, ecole.nom as nom_ecole FROM departement  INNER JOIN ecole ON ecole.id_ecole = departement.id_ecole   WHERE id_departement=$id";

    $result = $conn->query($sql);

    $html = '';
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $html .= ' 
        <form>           
                <div class="form-group">
                    <label for="nom">ID de département<span style="color:red">*</span></label>
                    <input type="text" class="form-control" value="' . $row["id_departement"] . '" id="id_departement" placeholder="Entrez le nom de département" disabled>
                </div>

                 <div class="form-group">
                    <label for="nom_ecole">Nom d\'école<span style="color:red">*</span></label>
                    <input type="text" class="form-control" value="' . $row["nom_ecole"] . '" id="nom_ecole" placeholder="Entrez le nom de département" disabled>
                </div>

                <div class="form-group">
                    <label for="nom">Nom de département<span style="color:red">*</span></label>
                    <input type="text" class="form-control" value="' . $row["nom_departement"] . '" name="nom" placeholder="Entrez le nom de département" required>
                </div>
        </form>        
        ';

        echo $html;
    } else {
        echo '<h3>Aucun résultat</h3>';
    }
}



if (isset($_POST['id_departement']) && isset($_POST['nom'])) {

    $id_departement = mysqli_real_escape_string($conn, $_POST['id_departement']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);

    $sql = "UPDATE departement SET nom='$nom' WHERE id_departement='$id_departement'";


    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
