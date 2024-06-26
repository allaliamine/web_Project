<?php
session_start();

require_once '../../includes/sidebar_prof.php';

$etudiants = $_SESSION['etd_niveau'];

$details = $_SESSION['details'];
// NombreAbsences



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter Absence</title>
    <link rel="stylesheet" href="./style_Prf.css">
</head>
<body>

    <div class="card col-xl-8 offset-3 mt-5 overflow-scroll">
        <div class="card-header">Formulaire d'absence des etudiants</div>
        <div class="card-body">
            
                
            <div class="form-group mb-4">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre d'absence</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>CNE</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($etudiants as $etd){ ?> 
                        <tr <?php if ($etd['NombreAbsences'] >= 3 ) echo 'class="table-danger"'; ?>>
                            <td><?= $etd['NombreAbsences']?></td>
                            <td><?= $etd['Nom']; ?></td>
                            <td><?= $etd['Prenom']; ?></td>
                            <td><?= $etd['CNE']; ?></td>
                            <td> <a href="../../routing/routing.php?action=details&id=<?php echo $etd['IdEtudiant'];?>"> voir les details d'absence</a></td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>

            <?php if(isset($_SESSION['supprimer-success'])) {?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div>
                        <?php echo $_SESSION['supprimer-success'];?>
                    </div>
                </div>
                <?php unset($_SESSION['supprimer-success']); ?>
            <?php } ?>

            <?php if(isset($_SESSION['justifier-success'])) {?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div>
                        <?php echo $_SESSION['justifier-success'];?>
                    </div>
                </div>
                <?php unset($_SESSION['justifier-success']); ?>
            <?php } ?>
            
            <?php if(isset($_SESSION['error-absence'])) {?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        <?php echo $_SESSION['error-absence'];?>
                    </div>
                </div>
                <?php unset($_SESSION['error-absence']); ?>
            <?php } ?>


            <?php if(isset($_SESSION['details_message_shown'])) {?>

                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        <?php echo $_SESSION['details_message_shown'];?>
                    </div>
                </div>

                <?php unset($_SESSION['details_message_shown']); ?>

                <?php } else if(!empty($details)){ ?>

                <div class="form-group mb-4">
                    <table class="table table-hover">

                        <thead>
                            <tr>
                                <th>absence de :</th>
                                <th>Seance de :</th>
                                <th>Date d'absence</th>
                                <th>Duree</th>
                                <th>Etat :</th>
                                <th>Action : </th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($details as $etd){ ?> 
                            <tr>
                                <td><?= $etd['Nom']." ".$etd['Prenom']; ?></td>
                                <td><?= $etd['Type']?></td>
                                <td><?= $etd['Date_abscence']?></td>
                                <td><?= $etd['Duree']." H"; ?></td>
                                <td><?= $etd['Etat']?></td>

                                <td>
                                    <a type="submit" name="Activer" class="btn btn-success" href="../../routing/routing.php?absence=justifier&id=<?= $etd['IdAbscence'] ?>&niveau=<?= $etd['IdNiveau'] ?>"> 
                                        Justifier
                                    </a>

                                    <a type="submit" name="Desactiver" class="btn btn-danger" href="../../routing/routing.php?absence=supprimer&id=<?= $etd['IdAbscence'] ?>&niveau=<?= $etd['IdNiveau'] ?>">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php unset($_SESSION['details']); ?>
            <?php } ?>
            


            
        </div>
    </div>
    
</body>
</html>