
<?php
    include_once('requete_gestion_tache.php');

    include_once('bd.php');

    $requete = "SELECT * FROM taches WHERE id_utilisateur = ?";

    $stmt = $db->prepare($requete);
    $stmt->execute([$_SESSION['user_id']]);
    $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tache.css">

    <title>Créer une tâche</title>
</head>

<body>
    <div class="gestion_tache">
        <div class="ajout_tache">
            <h2>Ajouter une nouvelle tâche</h2>
            <form action="" method="post">
                <label for="titre">Titre:</label>
                <input type="text" id="titre" name="titre" ><br><br>

                <label for="date_echeance">Date d'échéance:</label>
                <input type="date" id="date_echeance" name="date_echeance"><br><br>

                <label for="priorite">Priorité:</label>
                <select id="priorite" name="priorite">
                    <option value="selectionnez" disabled selected>Selectionnez</option>
                    <option value="faible">Faible</option>
                    <option value="moyenne">Moyenne</option>
                    <option value="elevee">Élevée</option>
                </select><br><br>

                <label for="etat">État:</label>
                <select id="etat" name="etat">
                    <option value="selectionnez" disabled selected>Selectionnez</option>
                    <option value="à faire">À faire</option>
                    <option value="en cours">En cours</option>
                    <option value="terminée">Terminée</option>
                </select><br><br>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4"></textarea><br><br>


                <button type="submit" name="creer_tache">Ajouter</button>
            </form>
        </div>
        <div class="liste_tache">
            <h2>Liste des tâches</h2>
            <table class="tableau_tache">
                <thead>
                <?php foreach ($taches as $tache) : ?>
                    <tr>
                        <th colspan="6">Date échéance <?php echo $tache['date_echeance'];?></th>
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
                        <td><button type="submit" name="voir_details"><a href="detail_tache.php?tache_id=<?php echo $tache['id_taches']; ?>">Voir détails</a></button></td>
                        <!-- <td><a href="detail_tache.php?tache_id=">Voir détails</a></td> -->
                    </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</body>

</html>