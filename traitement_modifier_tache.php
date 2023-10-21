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
