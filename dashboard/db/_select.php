<?php
session_start();
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

if (isset($_POST["IDecole"])) select_departement($_POST["IDecole"]);
if (isset($_POST["IDdepartement"])) select_filiere($_POST["IDdepartement"]);


getTypeUser();
function getTypeUser()
{

    $sql = "SELECT type FROM user WHERE id_user=" . $_SESSION['user']['id_user'];
    global $conn;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user']['type'] = $row['type'];

        return true;
    }
    return false;
}

function get_row_user($col)
{

    global $conn;

    $sql = "SELECT $col FROM user WHERE id_user=" . $_SESSION['user']['id_user'];

    $result = $conn->query($sql);
    // var_dump($result);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);

        return $row[$col];
    }

    return '';
}

function count_of($table)
{
    global $conn;

    $sql = "SELECT COUNT(*) FROM $table";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = mysqli_fetch_assoc($result);
        return $row["COUNT(*)"];
    }

    return 0;
}


function select($col, $table, $sql = '')
{
    global $conn;

    $sql = "SELECT $col FROM $table $sql";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result;
    }

    return '';
}

function select_departement($id)
{
    global $conn;

    $sql = "SELECT id_departement,nom FROM departement WHERE id_ecole = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $html = "";

        while ($row = mysqli_fetch_assoc($result)) {

            $html .= "<option value='" . $row['id_departement'] . "' >" . $row['nom'] . "</option>";
        }
        echo $html;
    }
    echo '';
}
function select_filiere($id)
{
    global $conn;
    $sql = "SELECT id_filiere , nom FROM filiere WHERE id_departement = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $html = "";

        while ($row = mysqli_fetch_assoc($result)) {

            $html .= "
<option value='" . $row['id_filiere'] . "' >" . $row['nom'] . "</option>";
        }
        echo $html;
    }
    echo '';
}
function custom_select_modify($table)
{
    global $conn;
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        return $result;
    }

    return 0;
}


function custom_select_etudiant()
{

    global $conn;

    $sql = "SELECT etudiant.id_etudiant, etudiant.cne, etudiant.date, user.nom as nom_user, user.prenom as prenom_user, user.email as email_user, filiere.nom as nom_filiere, ecole.nom as nom_ecole FROM etudiant INNER JOIN user on etudiant.id_user = user.id_user INNER JOIN filiere ON etudiant.id_filiere = filiere.id_filiere INNER JOIN ecole ON ecole.id_ecole = (SELECT departement.id_ecole FROM departement INNER JOIN filiere on departement.id_departement = filiere.id_departement WHERE filiere.id_filiere = etudiant.id_filiere )";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        return $result;
    }

    return 0;
}


function custom_select_professeur()
{

    global $conn;

    $sql = "SELECT professeur.id_prof, professeur.date, user.nom as nom_user, user.prenom as prenom_user, user.email as email_user, filiere.nom as nom_filiere, ecole.nom as nom_ecole FROM professeur INNER JOIN user on professeur.id_user = user.id_user INNER JOIN filiere ON professeur.id_filiere = filiere.id_filiere INNER JOIN ecole ON ecole.id_ecole = (SELECT departement.id_ecole FROM departement INNER JOIN filiere on departement.id_departement = filiere.id_departement WHERE filiere.id_filiere = professeur.id_filiere )";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        return $result;
    }

    return 0;
}


function custom_select_chef_departement()
{

    global $conn;

    $sql = "SELECT chef_departement.id_chef_departement, departement.nom as nom_departement, chef_departement.date, user.nom as nom_user, user.prenom as prenom_user, user.email as email_user, ecole.nom as nom_ecole FROM chef_departement INNER JOIN user on chef_departement.id_user = user.id_user INNER JOIN departement ON chef_departement.id_departement = departement.id_departement INNER JOIN ecole ON ecole.id_ecole = (SELECT departement.id_ecole FROM departement WHERE departement.id_departement = chef_departement.id_departement )";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        return $result;
    }

    return 0;
}


function custom_select_departement()
{

    global $conn;

    $sql = "SELECT departement.id_departement, departement.nom as nom_departement, departement.date, ecole.nom as nom_ecole FROM departement INNER JOIN ecole ON ecole.id_ecole = departement.id_ecole ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        return $result;
    }

    return 0;
}


function custom_select_filiere()
{

    global $conn;

    $sql = "SELECT filiere.id_filiere, filiere.nom as nom_filiere, filiere.date, departement.nom as nom_departement, ecole.nom as nom_ecole FROM filiere
    INNER JOIN departement ON departement.id_departement = filiere.id_departement
    INNER JOIN ecole ON ecole.id_ecole = departement.id_ecole
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        return $result;
    }

    return 0;
}
