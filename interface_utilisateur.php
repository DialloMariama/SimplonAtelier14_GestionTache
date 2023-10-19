<?php
include_once('requete_interface_utilisateur.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>Création de compte et connexion</h1>
<div class="form-container">
        <form action="" method="post" class="form" id="inscription-form">
            <h2>Créer un compte</h2>
            <label for="nom">Nom Utilisateur:</label>
            <input type="text" id="nom" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>"><br><br>
            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br><br>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?php echo isset($mot_de_passe) ? $mot_de_passe : ''; ?>"><br><br>
            <label for="confirmation_mot_de_passe">Confirmer le mot de passe :</label>
            <input type="password" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" ><br><br>
            <button type="submit" name="creer_compte">Créer un compte</button>
        </form>

        <div class="green-line"></div>

        <form class="form" id="connexion-form" method="post" action="">
            <h2 class="connexion">Connexion</h2>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br><br>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" ><br><br>
            <div class="foot">
                <button type="submit" name="se_connecter">Se connecter</button>
                <a href="reinitialisation_mot_de_passe.php">Mot de passe oublier?</a>
            </div>
        </form>
    </div>
</body>
</html>