       <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

           <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
               <img src="../assets/images/logo.jpg" alt="" srcset="" width="65" height="65">
           </a>

           <!-- Divider -->
           <hr class="sidebar-divider my-0">

           <!-- Nav Item - Dashboard -->
           <li class="nav-item active">
               <a class="nav-link" href="index.php">
                   <i class="fas fa-fw fa-tachometer-alt"></i>
                   <span>Dashboard</span></a>
           </li>

           <?php

            if ($_SESSION['user']['type'] == 1) {


            ?>
               <!-- Divider -->
               <hr class="sidebar-divider">

               <!-- Heading -->
               <div class="sidebar-heading">
                   Gestion
               </div>

               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                   <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">

                       <i class="fa fa-plus fa-cog"></i>
                       <span>Ajouter</span>
                   </a>
                   <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                       <div class="bg-white py-2 collapse-inner rounded">
                           <h6 class="collapse-header">Ajouter</h6>
                           <a class="collapse-item" href="ajouter_ecole.php">École</a>
                           <a class="collapse-item" href="ajouter_etudiant.php">Étudiant</a>
                           <a class="collapse-item" href="ajouter_professeur.php">Professeur</a>
                           <a class="collapse-item" href="ajouter_departement.php">Département</a>
                           <a class="collapse-item" href="ajouter_chef_departement.php">Chef département</a>
                           <a class="collapse-item" href="ajouter_filiere.php">Filière</a>


                       </div>
                   </div>
               </li>

               <li class="nav-item">
                   <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemModify" aria-expanded="true" aria-controls="collapseTwo">

                       <i class="fas fa-edit"></i>
                       <span>Modifier</span>
                   </a>
                   <div id="collapsemModify" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                       <div class="bg-white py-2 collapse-inner rounded">
                           <h6 class="collapse-header">Modifier</h6>
                           <a class="collapse-item" href="modifier_ecole.php">École</a>
                           <a class="collapse-item" href="modifier_etudiant.php">Étudiant</a>
                           <a class="collapse-item" href="modifier_professeur.php">Professeur</a>
                           <a class="collapse-item" href="modifier_chef_departement.php">Chef département</a>
                           <a class="collapse-item" href="modifier_departement.php">Département</a>
                           <a class="collapse-item" href="modifier_filiere.php">Filière</a>
                       </div>
                   </div>
               </li>


               <li class="nav-item">
                   <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tables" aria-expanded="true" aria-controls="collapseTwo">

                       <i class="fas fa-fw fa-table"></i>
                       <span>Les Tables</span>
                   </a>
                   <div id="tables" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                       <div class="bg-white py-2 collapse-inner rounded">
                           <h6 class="collapse-header">Tableaux </h6>
                           <a class="collapse-item" href="ecoles.php">Écoles</a>
                           <a class="collapse-item" href="etudiants.php">Étudiants</a>
                           <a class="collapse-item" href="professeurs.php">Professeurs</a>
                           <a class="collapse-item" href="departements.php">Départements</a>
                           <a class="collapse-item" href="chef_departement.php">Chef départements</a>
                           <a class="collapse-item" href="filieres.php">Filières</a>


                       </div>
                   </div>
               </li>

           <?php
            }
            if ($_SESSION['user']['type'] != 0) {

            ?>

               <!-- Divider -->
               <hr class="sidebar-divider">

               <!-- Heading -->
               <div class="sidebar-heading">
                   Les Pages
               </div>

               <li class="nav-item">
                   <a class="nav-link collapsed" href="reglages.php">
                       <i class="fas fa-user-cog"></i>
                       <span>Réglages</span>
                   </a>
               </li>

               <li class="nav-item">
                   <a class="nav-link collapsed" href="../logout.php">
                       <i class="fas fa-sign-out-alt"></i>
                       <span>Déconnecter</span>
                   </a>
               </li>

               <!-- Divider -->
               <hr class="sidebar-divider d-none d-md-block">

               <!-- Sidebar Toggler (Sidebar) -->
               <div class="text-center d-none d-md-inline">
                   <button class="rounded-circle border-0" id="sidebarToggle"></button>
               </div>
           <?php
            }
            ?>


       </ul>
       <!-- End of Sidebar -->