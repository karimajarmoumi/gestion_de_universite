<?php


require_once('db/_select.php');
if ($_SESSION['user']['type'] == 0) {
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

    <title>Réglages</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel='stylesheet' href='../assets/datatables/css/dataTables.responsive.css'>


    <style>
        label {
            display: block;
        }

        .pagination {
            justify-content: flex-end;
        }

        .file {
            visibility: hidden;
            position: absolute;
        }

        .disabled {
            background-color: #eaecf4;
            opacity: 1;
        }
    </style>

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
                                    <h6 class="m-0 font-weight-bold text-primary">Réglages</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="color:black">
                                    <div id="result">

                                    </div>

                                    <div class="profile-image text-center m-5">



                                        <form method="post" id="form">
                                            <?php

                                            $image = get_row_user('photo');
                                            echo ' <img class="img-profile rounded-circle" id="preview" src="img/user/' . $image . '" style="width:150px;height:150px;border:1px solid gray;padding:2px">'
                                            ?>






                                            <input type="file" class="file" accept="image/*" id="image" name="image">
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="Upload photo (La taille parfaite est 150px X 150px)" id="file">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse btn btn-dark">Choisir...</button>
                                                </div>
                                            </div>

                                            <div class="form-group text-left">
                                                <label for="nom">Nom : </label>
                                                <input type="text" class="form-control" value="<? echo get_row_user('nom') ?>" id="nom" name="nom" required>
                                            </div>
                                            <div class="form-group text-left">
                                                <label for="prenom">Prénom : </label>
                                                <input type="text" class="form-control" value="<? echo get_row_user('prenom') ?>" id="prenom" name="prenom" required>
                                            </div>
                                            <div class="form-group text-left">
                                                <label for="email">Email : </label>
                                                <input type="text" class="form-control" id="email" value="<? echo get_row_user('email') ?>" disabled>
                                            </div>
                                            <div id="result-password">

                                            </div>

                                            <div class="form-group text-left">
                                                <label for="password"> Mot de passe : </label>
                                                <input type="password" class="form-control disabled" name="password" id="password" placeholder="Click ici pour modifier le mot de passe">
                                            </div>
                                            <div class="form-group text-left " id="password_group" style="display:none">
                                                <label for="confirmer_password">Confirmer le Mot de passe : </label>
                                                <input type="password" class="form-control mb-4" id="confirmer_password" placeholder="Confirmer le mot de passe">
                                            </div>
                                            <button type="submit" class="btn btn-dark w-100" id="submit">Modifier</button>
                                        </form>
                                    </div>
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
    <script src="../assets/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/datatables/js/dataTables.responsive.min.js"></script>
    <script src="../assets/datatables/js/responsive.bootstrap4.min.js"></script>


    <script>
        $(document).ready(function() {
            $('table').DataTable();

            $("#password").click(function() {


                $('#password_group').css("display", "initial");
                $(this).removeClass('disabled')


            });


            $(document).on("click", ".browse", function() {
                var file = $(this).parents().find(".file");
                file.trigger("click");
            });
            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $("#file").val(fileName);

                var reader = new FileReader();
                reader.onload = function(e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("preview").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });


            $("#form").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "db/_reglage.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function(xhr, opts) {
                        //$("#preview").fadeOut();

                        var passe = $('#password').val();
                        var passe_confirm = $('#confirmer_password').val();

                        if (passe != passe_confirm) {
                            $('#result-password').html('<div class="alert alert-danger" id="denger-alert" role="alert">Les deux mots de passe ne sont pas les mêmes</div>');
                            $("#denger-alert").fadeTo(2000, 500).slideUp(500, function() {
                                $("#denger-alert").slideUp(500);
                            });
                            xhr.abort();

                        }


                    },
                    success: function(data) {
                        console.log(data);

                        if (data) {
                            // invalid file format.
                            location.reload(true);
                        } else {
                            $('#result').html('<div class="alert alert-danger " id="denger-alert" role="alert">Vos informations n\'ont pas été mises à jour avec succès');
                            $("#denger-alert").fadeTo(2000, 500).slideUp(500, function() {
                                $("#denger-alert").slideUp(500);
                            });
                        }
                    },
                    error: function(e) {
                        console.log("error");
                    }
                });
            }));

        });
    </script>

</body>

</html>