<?php
session_start();
require_once '../../includes/sidebar_admin.php';

 $logins = isset($_SESSION['journal_of_user'])? $_SESSION['journal_of_user']: $_SESSION['logins'];
 $recodsPerPage = 30;
 $totalRecords = count($logins);
 $totalPages = ceil($totalRecords / $recodsPerPage);

 //numero de page
 $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

 //index de recuperation des donnes de $logins selon num de page
 $start_index = ($current_page - 1) * $recodsPerPage;
 
 //extraction des donnes pour affichage apres
 $pageRecords = array_slice($logins, $start_index, $recodsPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracker</title>
    <link rel="stylesheet" href="./style_admin.css">
</head>
<body>
    <div class="card col-xl-8 offset-3 mt-5 overflow-scroll">
        <div class="card-header">Formulaire d'Activite des utilisateurs</div>
        <div class="card-body">      
            <div class="search-bar-div">
                <form class="navbar-search me-auto my-0" method="POST" action="../../routing/routing.php">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 search" name="track" placeholder="Rcherche"> 
                        <button class="btn search" type="submit" name="searchUser">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
           
            <div class="table-responsive">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Adresse IP</th>
                            <th>Criticite</th>
                            <th>CNE/CIN</th>
                            <th>Date</th>
                            <th>heure</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pageRecords as $log) { ?> 
                            <tr <?php if ($log['Criticite'] == 'error'){ echo 'class="table-danger"';} if (str_contains($log['action'], 'authentifier')) { echo 'class="table-success"';}?>>
                                <td><?= $log['AdressIP']; ?></td>
                                <td><?= $log['Criticite']; ?></td>
                                <td><?= $log['CNE']; ?></td>
                                <td><?= $log['Date']; ?></td>
                                <td><?= $log['Heure']; ?></td>
                                <td><?= $log['action']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
            </div>

            <!-- Pagination -->
            <nav>
                <ul class="pagination flex-wrap">
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <li class="page-item <?= $i == $current_page ? 'active' : ''; ?>">
                            <a class="page-link"  href="./tracker_users.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>

        </div>
    </div>
</body>
</html>
