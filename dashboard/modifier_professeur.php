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

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel='stylesheet' href='../assets/datatables/css/dataTables.responsive.css'>


    <style>
        label {
            display: block;
        }

        .pagination {
            justify-content: flex-end;
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
                                    <h6 class="m-0 font-weight-bold text-primary">Tableaux de données des professeurs</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="color:black">
                                    <div id="result">

                                    </div>

                                    <table class="table table-striped table-bordered table-hover dt-responsive w-100">

                                        <thead class="w-100">
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom</th>
                                                <th>prénom</th>
                                                <th>email</th>
                                                <th>Ecole</th>
                                                <th>Filiere</th>
                                                <th>Date de création</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="w-100">
                                            <?php $result = custom_select_professeur();

                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo '<td>' . $row["id_prof"] . '</td>';
                                                    echo '<td>' . $row["nom_user"] . '</td>';
                                                    echo '<td>' . $row["prenom_user"] . '</td>';
                                                    echo '<td>' . $row["email_user"] . '</td>';
                                                    echo '<td>' . $row["nom_ecole"] . '</td>';
                                                    echo '<td>' . $row["nom_filiere"] . '</td>';
                                                    echo '<td>' . $row["date"] . '</td>';
                                                    echo '<td class="text-center"> <i  class="fa fa-edit " onclick="showEdit(' . $row["id_prof"] . ')" style="color:#009de8;cursor:pointer;font-size: 16px;"></i><i class="fa fa-trash" onclick="showRemove(' . $row["id_prof"] . ')" style="margin-left:15px;color:red;cursor:pointer;font-size: 16px;"></i></td>';
                                                    echo "</tr>";
                                                }
                                            }

                                            ?>
                                        </tbody>

                                    </table>


                                    <!-- Edit Model -->

                                    <div class="modal fade" id="ecoleModel" tabindex="-1" aria-labelledby="ecoleModel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ecoleModelLabel">Éditer professeur</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="resultEdit">

                                                    </div>
                                                    <div id="editProfesseur">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" id="saveEdit">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Remove Model -->

                                    <div class="modal fade" id="removeModel" tabindex="-1" aria-labelledby="removeModel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="removeModel">Supprimer professeur</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="resultRemove">

                                                    </div>
                                                    <div>
                                                        <div class="alert alert-danger text-center" role="alert">
                                                            <h1>Voulez-vous supprimer définitivement cette professeur?</h1>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger" id="remove">Supprimer</button>
                                                </div>
                                            </div>
                                        </div>
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
        function showEdit(id) {

            $(document).ready(function() {
                $.ajax({
                    url: "db/_modifier_professeur.php",
                    type: "GET",
                    data: {
                        editProfesseurID: id,
                    },

                    success: function(result) {

                        if (result != '') {
                            $('#editProfesseur').html(result);
                            $('#ecoleModel').modal('show');
                            $('#id_prof').val(id);
                            $('#saveEdit').attr('data-id', id)

                        } else if (dataResult.statusCode == 201) {
                            $('#resultEdit').html('<div class="alert alert-danger" id="denger-alert" role="alert">Le professeur n\'a pas été modifier avec succès </div>');
                            $("#denger-alert").fadeTo(2000, 500).slideUp(500, function() {
                                $("#denger-alert").slideUp(500);
                            });
                        }

                    },
                    cach: false,
                });
            });

        }

        function showRemove(id) {

            $(document).ready(function() {
                $('#remove').attr('data-id', id);

                $('#removeModel').modal('show')
            });

        }


        function onchangeEcole() {
            $(document).ready(function() {
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
        }

        function onchangeDepartement() {

            $(document).ready(function() {
                var departement = $('#inputGroupSelect3').find(":selected").val();

                if (departement != '') {
                    $('#inputGroupSelect4').prop('disabled', false);

                    $.ajax({
                        url: "db/_select.php",
                        type: "POST",
                        data: {
                            IDdepartement: departement,
                        },
                        success: function(result) {

                            $('#inputGroupSelect4').html(
                                "<option value='' selected disabled>choisir...</option>" + result
                            )

                        }

                    });
                }
            });

        }

        $(document).ready(function() {
            $(' table').DataTable();


            $('#saveEdit').click(function() {

                var id_prof = $('#saveEdit').data('id');
                var ecole = $('#inputGroupSelect2').find(":selected").val();
                var departement = $('#inputGroupSelect3').find(":selected").val();
                var filiere = $('#inputGroupSelect4').find(":selected").val();

                if (ecole == "") {
                    $('#inputGroupSelect2').css('border-color', 'red')
                } else {
                    $('#inputGroupSelect2').css('border-color', '')
                }

                if (departement == "") {
                    $('#inputGroupSelect3').css('border-color', 'red')
                } else {
                    $('#inputGroupSelect3').css('border-color', '')
                }

                if (filiere == "") {
                    $('#inputGroupSelect4').css('border-color', 'red')
                } else {
                    $('#inputGroupSelect4').css('border-color', '')
                }


                if (ecole != '' && departement != '' && filiere != '') {

                    $.ajax({
                        url: "db/_modifier_professeur.php",
                        type: "POST",
                        data: {
                            id_prof: id_prof,
                            filiere: filiere,

                        },

                        success: function(result) {

                            var dataResult = JSON.parse(result);
                            if (dataResult.statusCode == 200) {
                                location.reload(true);

                            } else if (dataResult.statusCode == 201) {
                                $('#resultEdit').html('<div class="alert alert-danger" id="denger-alert" role="alert">Le professeur n\'a pas été modifie avec succès </div>');
                                $("#denger-alert").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#denger-alert").slideUp(500);
                                });
                            }

                        },
                        cache: false,
                    });
                }

            });

            $('#remove').click(function() {
                $.ajax({
                    url: "db/_modifier_professeur.php",
                    type: "GET",
                    data: {
                        removeProfesseurID: $(this).data('id'),
                    },
                    success: function(result) {
                        if (result = 1) {
                            location.reload(true);
                        } else {
                            $('#resultRemove').html('<div class="alert alert-danger " id="denger-alert" role="alert">Le professeir n\'a pas été supprimée avec succès </div>');
                            $("#denger-alert").fadeTo(2000, 500).slideUp(500, function() {
                                $("#denger-alert").slideUp(500);
                            });
                        }

                    },
                    cach: false,
                });
            })


        });
    </script>

</body>

</html>