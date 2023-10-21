
<?php
include_once('requete_gestion_tache.php');
include_once('bd.php');

if (isset($_POST['modifier_tache'])) {
    $tache_id = $_POST['tache_id'];

    $nom_tache = $_POST['nom_tache'];
    $description = $_POST['description'];
    $priorite = $_POST['priorite'];
    $etat = $_POST['etat'];

    $update_query = "UPDATE taches SET nom_tache = ?, description = ?, priorite = ?, etat = ? WHERE id_taches = ?";
    $stmt = $db->prepare($update_query);
    $stmt->execute([$nom_tache, $description, $priorite, $etat, $tache_id]);

    header('Location: detail_tache.php?tache_id=' . $tache_id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la tâche</title>
</head>
<body>
<form action="" method="POST">
    <input type="hidden" name="tache_id" value="<?php echo $tache['id_taches']; ?>">
    
    <label for="nom_tache">Nom de la tâche :</label>
    <input type="text" name="nom_tache" value="<?php echo $tache['nom_tache'];?>">
    
    <label for="description">Description :</label>
    <textarea name="description"><?php echo $tache['description']; ?></textarea>
    
    <label for="priorite">Priorité :</label>
    <select name="priorite">
        <option value="Basse" <?php if ($tache['priorite'] == 'Basse') echo 'selected'; ?>>Basse</option>
        <option value="Moyenne" <?php if ($tache['priorite'] == 'Moyenne') echo 'selected'; ?>>Moyenne</option>
        <option value="Élevée" <?php if ($tache['priorite'] == 'Élevée') echo 'selected'; ?>>Élevée</option>
    </select>
    
    <label for="etat">État :</label>
    <select name="etat">
        <option value="À faire" <?php if ($tache['etat'] == 'À faire') echo 'selected'; ?>>À faire</option>
        <option value="En cours" <?php if ($tache['etat'] == 'En cours') echo 'selected'; ?>>En cours</option>
        <option value="Terminée" <?php if ($tache['etat'] == 'Terminée') echo 'selected'; ?>>Terminée</option>
    </select>

    <button type="submit" name="modifier_tache">Modifier la tâche</button>
</form>
</body>
</html>
