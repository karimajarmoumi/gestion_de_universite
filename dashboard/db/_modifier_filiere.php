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



if (isset($_GET["editFiliereID"])) edit($_GET["editFiliereID"]);
if (isset($_GET["removeFiliereID"])) remove($_GET["removeFiliereID"]);


function remove($id)
{

    global $conn;

    $sql = "DELETE FROM filiere WHERE id_filiere=$id";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}

function edit($id)
{
    global $conn;

    $sql = "SELECT filiere.id_filiere, filiere.nom as nom_filiere, filiere.date, departement.nom as nom_departement,  ecole.nom as nom_ecole FROM filiere  
    INNER JOIN departement ON departement.id_departement = filiere.id_departement
    INNER JOIN ecole ON ecole.id_ecole = departement.id_ecole WHERE id_filiere=$id";

    $result = $conn->query($sql);

    $html = '';
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $html .= ' 
        <form>           
                <div class="form-group">
                    <label for="nom">ID de filière</label>
                    <input type="text" class="form-control" value="' . $row["id_filiere"] . '" id="id_filiere" placeholder="Entrez le nom de département" disabled>
                </div>

                 <div class="form-group">
                    <label for="nom_ecole">Nom d\'école</label>
                    <input type="text" class="form-control" value="' . $row["nom_ecole"] . '" id="nom_ecole" placeholder="Entrez le nom de département" disabled>
                </div>

                <div class="form-group">
                    <label for="nom">Nom de filière<span style="color:red">*</span></label>
                    <input type="text" class="form-control" value="' . $row["nom_filiere"] . '" name="nom" placeholder="Entrez le nom de département" >
                </div>

                  <div class="form-group">
                    <label for="nom">Date de création</label>
                    <input type="text" class="form-control" value="' . $row["date"] . '" name="nom_departement" placeholder="Entrez le nom de département" disabled>
                </div>
        </form>        
        ';

        echo $html;
    } else {
        echo '<h3>Aucun résultat</h3>';
    }
}



if (isset($_POST['id_filiere']) && isset($_POST['nom'])) {

    $id_filiere = mysqli_real_escape_string($conn, $_POST['id_filiere']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);

    $sql = "UPDATE filiere SET nom='$nom' WHERE id_filiere='$id_filiere'";


    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
