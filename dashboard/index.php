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

    <title> Dashboard</title>

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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nombre d'École</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count_of('ecole'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-university fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Nombre des filières</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count_of('filiere'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-archive fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Nombre des professeurs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count_of('professeur'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                nombre d'étudiants</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count_of('etudiant'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Université Chouaib Doukkali</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style="color:black">
                                    <img class="img-fluid w-100" src="../assets/images/universite.jpg" alt="">
                                    <h2 class="mt-2">Qui est Chouaib Doukkali</h2>
                                    <p>L’université porte le nom d’une illustre personnalité marocaine du XXe siècle. <strong>Cheikh Abou Chouaïb Doukkali</strong> est un savant et résistant marocain (1878-1937) connu pour avoir participé à la propagation des idées réformistes de la Nahda au Maroc et comme un pionnier du mouvement indépendantiste. Il a exercé les fonctions de ministre de la justice et de l’enseignement et a effectué un long séjour au Moyen-Orient où il a acquis une grande notoriété.</p>
                                    <h2 class="mt-2">Mission</h2>

                                    <p>
                                        En référence à l’article 3 de la loi 01-00, portant organisation de l’enseignement supérieur, l’université a pour principales missions :
                                        <ul>
                                            <li>
                                                La contribution au renforcement de l’identité islamique et nationale ;
                                            </li>
                                            <li>
                                                La formation initiale et la formation continue ;
                                            </li>
                                            <li>
                                                Le développement et la diffusion. du savoir, de la connaissance et de la culture;
                                            </li>
                                            <li>
                                                Préparation des jeunes à l’insertion dans la vie active notamment par le développement du savoir-faire ;
                                            </li>
                                            <li>
                                                Recherche scientifique et technologique ;
                                            </li>
                                            <li>

                                                Réalisation d’expertises ;
                                            </li>
                                            <li>
                                                Contribution au développement global du pays ;
                                            </li>
                                            <li>
                                                Contribution à la promotion des valeurs universelles
                                            </li>

                                        </ul>

                                    </p>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>