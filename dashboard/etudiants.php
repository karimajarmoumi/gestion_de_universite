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
                                    <h6 class="m-0 font-weight-bold text-primary">Tableaux de données des étudiants</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="color:black">
                                    <div id="result">

                                    </div>
                                    <table class="table table-striped table-bordered table-hover dt-responsive w-100">

                                        <thead class="w-100">
                                            <tr>
                                                <th>ID</th>
                                                <th>CNE</th>
                                                <th>Nom</th>
                                                <th>prénom</th>
                                                <th>email</th>
                                                <th>Ecole</th>
                                                <th>Filiere</th>
                                                <th>Date de création</th>
                                            </tr>
                                        </thead>
                                        <tbody class="w-100">
                                            <?php $result = custom_select_etudiant();

                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo '<td>' . $row["id_etudiant"] . '</td>';
                                                    echo '<td>' . $row["cne"] . '</td>';
                                                    echo '<td>' . $row["nom_user"] . '</td>';
                                                    echo '<td>' . $row["prenom_user"] . '</td>';
                                                    echo '<td>' . $row["email_user"] . '</td>';
                                                    echo '<td>' . $row["nom_ecole"] . '</td>';
                                                    echo '<td>' . $row["nom_filiere"] . '</td>';
                                                    echo '<td>' . $row["date"] . '</td>';
                                                    echo "</tr>";
                                                }
                                            }

                                            ?>
                                        </tbody>

                                    </table>
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
        });
    </script>

</body>

</html>