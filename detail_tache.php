

<?php
    include_once('requete_gestion_tache.php');
    include_once('bd.php');

    if (isset($_GET['tache_id'])) {
        $tache_id = $_GET['tache_id'];

        $requete = "SELECT * FROM taches WHERE id_taches = ?";
        $stmt = $db->prepare($requete);
        $stmt->execute([$tache_id]);
        $tache = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($tache)) {
            // j'ai affiché le resultat dans le tableau HTML
        } else {
            echo "Tâche non trouvée.";
        }
    } else {
        echo "Paramètre tache_id manquant.";
    }

    
if (isset($_POST['terminer_tache'])) {
    $tache_id = $_POST['tache_id'];

    $update_query = "UPDATE taches SET etat = 'Terminée' WHERE id_taches = ?";
    $stmt = $db->prepare($update_query);
    $stmt->execute([$tache_id]);

    header('Location: detail_tache.php?tache_id=' . $tache_id);
    exit;
}

if (isset($_POST['supprimer_tache']) && isset($_POST['tache_id'])) {
    $tache_id = $_POST['tache_id'];

    $delete_query = "DELETE FROM taches WHERE id_taches = ?";
    $stmt = $db->prepare($delete_query);

    if ($stmt->execute([$tache_id])) {
        header('Location: gestion_des_taches.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tache.css">
    <title>Document</title>
</head>
<body>
<!-- <div class="liste_tache"> -->
            <h2>Liste des tâches</h2>
            <table class="tableau_tache">
                <thead>
                    <tr>
                        <th colspan="6">Date échéance le <?php echo $tache['date_echeance']; ?></th>
                    </tr>
                    <tr>
                        <th>Nom tâche</th>
                        <th>Description</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $tache['nom_tache']; ?></td>
                        <td><?php echo $tache['description']; ?></td>
                        <td><?php echo $tache['priorite']; ?></td>
                        <td><?php echo $tache['etat']; ?></td>
                        <td class="termine_supprime">
                        <div class="form-container">
                            <form action="" method="POST" class="form-terminer">
                                <input type="hidden" name="tache_id" value="<?php echo $tache['id_taches']; ?>">
                                <button type="submit" name="terminer_tache">Terminer la tâche</button>
                            </form>
                        </div>
                        <div class="form-container">
                            <form action="" method="POST" class="form-supprimer">
                                <input type="hidden" name="tache_id" value="<?php echo $tache['id_taches']; ?>">
                                <button type="submit" name="supprimer_tache" class="supprimer_tache">Supprimer la tache</button>
                            </form>
                        </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        <!-- </div> -->
        <button type="submit" name="liste_tache"><a href="gestion_des_taches.php">liste des taches</a></button>

</body>
</html>