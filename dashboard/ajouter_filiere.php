<?php


require_once('db/_select.php');
if ($_SESSION['user']['type'] != 1) {
    header('Location: ../verification.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require('_sidebar.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                require('_navbar.php');
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ajouter une filière</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="color:black">
                                    <div id="result">

                                    </div>
                                    <form method="post">



                                        <div class="form-group">
                                            <label for="inputGroupSelect2">Choisissez le nom de l'école<span style="color:red">*</span></label>
                                            <div class="input-group mb-2">
                                                <select class="custom-select" id="inputGroupSelect2">

                                                    <option value="" selected disabled>choisir...</option>
                                                    <?php
                                                    $result =  select('id_ecole, nom', 'ecole', 'ORDER BY nom ASC');
                                                    if ($result != '') {

                                                        if ($result->num_rows > 0) {

                                                            while ($row = mysqli_fetch_assoc($result)) {

                                                                echo "<option value=" . $row['id_ecole'] . ">" . $row['nom'] . "</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <a class="ml-2" href="ajouter_ecole.php"> Ajouter une école </a>

                                        </div>



                                        <label for="inputGroupSelect">Choisissez le nom de département<span style="color:red">*</span></label>
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <select class="custom-select" id="inputGroupSelect" disabled>

                                                    <option value="" selected disabled>choisir...</option>
                                                    <?php
                                                    $result =  select('id_departement, nom', 'departement', 'ORDER BY nom ASC');
                                                    if ($result != '') {

                                                        if ($result->num_rows > 0) {

                                                            while ($row = mysqli_fetch_assoc($result)) {

                                                                echo "<option value=" . $row['id_departement'] . ">" . $row['nom'] . "</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <a class="ml-2" href="ajouter_departement.php"> Ajouter un département </a>

                                        </div>

                                        <div class="form-group">
                                            <label for="nom">Nom de filière<span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="nom" placeholder="Entrez le nom de département" required>
                                        </div>

                                        <button type="button" id="submit" class="btn btn-info w-100">Ajouter</button>
                                    </form>


                                </div>
                            </div>
                        </div>


                    </div>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require('_footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



    <script>
        $(document).ready(function() {




            $('#inputGroupSelect2').on('change', function() {

                var ecole = $('#inputGroupSelect2').find(":selected").val();

                if (ecole != '') {
                    $('#inputGroupSelect').prop('disabled', false);

                    $.ajax({
                        url: "db/_select.php",
                        type: "POST",
                        data: {
                            IDecole: ecole,
                        },
                        success: function(result) {

                            $('#inputGroupSelect').html(
                                "<option value='' selected disabled>choisir...</option>" + result
                            )

                        }

                    });
                }

            });

            $('#inputGroupSelect').on('change', function() {

                var ecole = $('#inputGroupSelect2').find(":selected").val();

                if (ecole != '') {
                    $('#inputGroupSelect').css('border-color', '')
                }

            });





            $('#submit').click(function() {

                var nom = $('input[name="nom"]').val();
                var departement = $('#inputGroupSelect').find(":selected").val();

                if (nom == "") {
                    $('input[name="nom"]').css('border-color', 'red')
                } else {
                    $('input[name="nom"]').css('border-color', '')
                }
                if (departement == "") {
                    $('#inputGroupSelect').css('border-color', 'red')
                } else {
                    $('#inputGroupSelect').css('border-color', '')
                }

                if (nom != '' && departement != '') {

                    $.ajax({
                        url: "db/_ajouter_filiere.php",
                        type: "POST",
                        data: {
                            nom: nom,
                            departement: departement,

                        },

                        success: function(result) {
                            var dataResult = JSON.parse(result);
                            if (dataResult.statusCode == 200) {
                                $('input[name="nom"]').val('');
                                $('#result').html('<div class="alert alert-success" id="success-alert" role="alert">La Filière a été ajoutée avec succès </div>');
                                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#success-alert").slideUp(500);
                                });

                            } else if (dataResult.statusCode == 201) {
                                $('#result').html('<div class="alert alert-danger" id="denger-alert" role="alert">La Filière n\'a pas été ajoutée avec succès </div>');
                                $("#denger-alert").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#denger-alert").slideUp(500);
                                });
                            }

                        },
                        cache: false,
                    });
                }

            });
        });
    </script>

</body>

</html>