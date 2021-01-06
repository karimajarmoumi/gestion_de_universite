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



if (isset($_GET["editChefDepartementID"])) edit($_GET["editChefDepartementID"]);
if (isset($_GET["removeChefDepartementID"])) remove($_GET["removeChefDepartementID"]);


function remove($id)
{

    global $conn;

    $sql = "DELETE FROM chef_departement WHERE id_chef_departement=$id";

    if ($conn->query($sql) === TRUE) {
        echo 1;
    } else {
        echo 0;
    }
}

function edit($id)
{
    global $conn;

    $sql = "SELECT chef_departement.id_chef_departement, departement.nom as nom_departement, chef_departement.date, user.nom as nom_user, user.prenom as prenom_user, user.email as email_user, ecole.nom as nom_ecole FROM chef_departement INNER JOIN user on chef_departement.id_user = user.id_user INNER JOIN departement ON chef_departement.id_departement = departement.id_departement INNER JOIN ecole ON ecole.id_ecole = (SELECT departement.id_ecole FROM departement  WHERE departement.id_departement = chef_departement.id_departement ) WHERE chef_departement.id_chef_departement=$id";

    $result = $conn->query($sql);


    $ecoleHTML = '<form method="post">
                 <div class="form-group">
                        <label for="prof">ID</label>
                        <input type="text" class="form-control" id="id_chef_departement"   disabled>
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

        $html = $ecoleHTML . $departementHTML;

        echo $html;
    } else {
        echo '<h3>Aucun résultat</h3>';
    }
}



if (isset($_POST['id_chef_departement']) && isset($_POST['departement'])) {

    $id_chef_departement = mysqli_real_escape_string($conn, $_POST['id_chef_departement']);
    $departement = mysqli_real_escape_string($conn, $_POST['departement']);

    $sql = "UPDATE chef_departement SET id_departement='$departement' WHERE id_chef_departement='$id_chef_departement'";


    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
    mysqli_close($conn);
}
