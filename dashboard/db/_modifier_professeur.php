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



if (isset($_GET["editProfesseurID"])) edit($_GET["editProfesseurID"]);
if (isset($_GET["removeProfesseurID"])) remove($_GET["removeProfesseurID"]);


function remove($id)
{

    global $conn;

    $sql = "DELETE FROM professeur WHERE id_prof=$id";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}

function edit($id)
{
    global $conn;

    $sql = "SELECT professeur.id_prof, professeur.date, user.nom as nom_user, user.prenom as prenom_user, user.email as email_user, filiere.nom as nom_filiere, ecole.nom as nom_ecole, ecole.id_ecole as id_ecole FROM professeur INNER JOIN user on professeur.id_user = user.id_user INNER JOIN filiere ON professeur.id_filiere = filiere.id_filiere INNER JOIN ecole ON ecole.id_ecole = (SELECT departement.id_ecole FROM departement INNER JOIN filiere on departement.id_departement = filiere.id_departement WHERE filiere.id_filiere = professeur.id_filiere ) WHERE professeur.id_prof=$id";

    $result = $conn->query($sql);


    $ecoleHTML = '<form method="post">
                 <div class="form-group">
                        <label for="prof">ID</label>
                        <input type="text" class="form-control" id="id_prof"   disabled>
                 </div>

            <div class="form-group">
            <label for="inputGroupSelect2">Choisissez le nom de l\'école<span style="color:red">*</span></label>
            <div class="input-group mb-2">
            <select class="custom-select" onchange="onchangeEcole()" id="inputGroupSelect2">
            <option value="" selected disabled>choisir...</option>';


    $ecoleResult =  select('id_ecole, nom', 'ecole', 'ORDER BY nom ASC');
    if ($ecoleResult != '') {

        if ($ecoleResult->num_rows > 0) {

            while ($row = mysqli_fetch_assoc($ecoleResult)) {

                $ecoleHTML .= '<option value=' . $row['id_ecole'] . '>' . $row['nom'] . '</option>';
            }
        }
    }

    $ecoleHTML .= '</select></div></div>';

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $departementHTML = '
            <div class="form-group">
                <label for="inputGroupSelect3">Choisissez le nom de département <span style="color:red">*</span></label>
                <div class="input-group mb-2">
                    <select class="custom-select" id="inputGroupSelect3" onchange="onchangeDepartement()" disabled>

                        <option value="" selected disabled>choisir...</option>

                    </select>
                </div>
                

            </div>';

        $filiereHTML = ' <div class="form-group">
                        <label for="inputGroupSelect4">Choisissez le nom de la filiere <span style="color:red">*</span></label>
                        <div class="input-group mb-2">
                            <select class="custom-select" id="inputGroupSelect4" disabled>

                                <option value="" selected disabled>choisir...</option>

                            </select>
                        </div>
                        

                    </div>';


        $html = $ecoleHTML . $departementHTML . $filiereHTML;

        echo $html;
    } else {
        echo '<h3>Aucun résultat</h3>';
    }
}



if (isset($_POST['id_prof']) && isset($_POST['filiere'])) {

    $id_prof = mysqli_real_escape_string($conn, $_POST['id_prof']);
    $filiere = mysqli_real_escape_string($conn, $_POST['filiere']);

    $sql = "UPDATE professeur SET id_filiere='$filiere' WHERE id_prof='$id_prof'";


    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
