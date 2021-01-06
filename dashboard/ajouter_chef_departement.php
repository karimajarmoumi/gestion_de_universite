<?php


require_once('db/_select.php');

if (getTypeUser() != 1) {
    header('Location: index.php');
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
                                    <h6 class="m-0 font-weight-bold text-primary">Ajouter chef de département</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="color:black">
                                    <div id="result">

                                    </div>
                                    <form method="post">

                                        <div class="form-group">
                                            <label for="inputGroupSelect">Choisissez un utilisateur<span style="color:red">*</span></label>
                                            <div class="input-group mb-2">
                                                <select class="custom-select" id="inputGroupSelect">

                                                    <option value="" selected disabled>choisir...</option>
                                                    <?php
                                                    $result =  select('id_user, nom, prenom, email', 'user', 'ORDER BY nom ASC');
                                                    if ($result != '') {

                                                        if ($result->num_rows > 0) {

                                                            while ($row = mysqli_fetch_assoc($result)) {

                                                                echo "<option value=" . $row['id_user'] . ">" . $row['nom'] . " " . $row['prenom'] . " | " . $row['email'] . "</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>


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


                                        <div class="form-group">
                                            <label for="inputGroupSelect3">Choisissez le nom de département <span style="color:red">*</span></label>
                                            <div class="input-group mb-2">
                                                <select class="custom-select" id="inputGroupSelect3" disabled>

                                                    <option value='' selected disabled>choisir...</option>

                                                </select>
                                            </div>
                                            <a class="ml-2" href="ajouter_departement.php"> Ajouter un département </a>

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
                    $('#inputGroupSelect3').prop('disabled', false);

                    $.ajax({
                        url: "db/_select.php",
                        type: "POST",
                        data: {
                            IDecole: ecole,
                        },
                        success: function(result) {

                            $('#inputGroupSelect3').html(
                                "<option value='' selected disabled>choisir...</option>" + result
                            )

                        }

                    });
                }

            });



            $('#submit').click(function() {


                var user = $('#inputGroupSelect').find(":selected").val();
                var ecole = $('#inputGroupSelect2').find(":selected").val();
                var departement = $('#inputGroupSelect3').find(":selected").val();

                if (user == "") {
                    $('#inputGroupSelect').css('border-color', 'red')
                } else {
                    $('#inputGroupSelect').css('border-color', '')
                }

                if (ecole == "") {
                    $('#inputGroupSelect2').css('border-color', 'red')
                } else {
                    $('#inputGroupSelect2').css('border-color', '')
                }

                if (departement == "") {
                    console.log(ecole)
                    $('#inputGroupSelect3').css('border-color', 'red')
                } else {
                    $('#inputGroupSelect3').css('border-color', '')
                }

                if (user != '' && ecole != '' && departement != '') {

                    $.ajax({
                        url: "db/_ajouter_chef_departement.php",
                        type: "POST",
                        data: {
                            user: user,
                            departement: departement,

                        },

                        success: function(result) {
                            var dataResult = JSON.parse(result);
                            if (dataResult.statusCode == 200) {
                                $('input[name="nom"]').val('');
                                $('#result').html('<div class="alert alert-success" id="success-alert" role="alert">Le chef de département a été ajoutée avec succès </div>');
                                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#success-alert").slideUp(500);
                                });

                            } else if (dataResult.statusCode == 201) {
                                $('#result').html('<div class="alert alert-danger" id="denger-alert" role="alert">Le chef de département n\'a pas été ajoutée avec succès </div>');
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