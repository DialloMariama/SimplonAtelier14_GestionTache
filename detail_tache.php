

<?php
    include_once('requete_gestion_tache.php');
    include_once('bd.php');

    // Vérifiez si le paramètre tache_id est défini dans l'URL
    if (isset($_GET['tache_id'])) {
        $tache_id = $_GET['tache_id'];

        // Chargez la tâche correspondante à partir de la base de données
        $requete = "SELECT * FROM taches WHERE id_taches = ?";
        $stmt = $db->prepare($requete);
        $stmt->execute([$tache_id]);
        $tache = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifiez si la variable $tache est définie avant de l'afficher
        if (isset($tache)) {
            // Affichez les détails de la tâche
            // ...
        } else {
            // Tâche non trouvée, affichez un message d'erreur ou redirigez l'utilisateur
            echo "Tâche non trouvée.";
        }
    } else {
        // Paramètre tache_id non fourni dans l'URL, affichez un message d'erreur ou redirigez l'utilisateur
        echo "Paramètre tache_id manquant.";
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
<div class="liste_tache">
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
                        <td>
                            <button type="submit" name="voir_details">Terminée la tache</button>
                            <button type="submit" name="supprimer_tache" class="supprimer_tache">Supprimer la tache</button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="submit" name="liste_tache"><a href="gestion_des_taches.php">liste des taches</a></button>

</body>
</html>