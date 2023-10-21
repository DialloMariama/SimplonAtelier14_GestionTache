
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <?php
    include_once('requete_interface_utilisateur.php');
    
    $nom = "";

    if (!isset($_SESSION['user_nom'])) {
        echo " echec";
    }
    
    $nom = $_SESSION['user_nom'];
    ?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <p>Bonjour <?php echo $nom; ?>, vous êtes connecté.</p>
</body>
</html>