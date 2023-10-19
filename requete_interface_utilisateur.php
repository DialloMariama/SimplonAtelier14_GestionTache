<?php
session_start();
include_once('bd.php');

$nom="";
$email="";
$mot_de_passe="";
$confirmation_mot_de_passe="";
$erreurs=[];

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST["creer_compte"])){
        $nom= $_POST['nom'];
        $email= $_POST['email'];
        $mot_de_passe= $_POST['mot_de_passe'];
        $confirmation_mot_de_passe= $_POST['confirmation_mot_de_passe'];

        $regex_nom = "/^[a-zA-Z ']{2,}$/";
        if (!preg_match($regex_nom, $_POST["nom"])) {
            $erreurs[] = "Le nom est invalide.";
        }
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            array_push($erreurs, "Entrez un email valide");
        }
        if(!(strlen($mot_de_passe) == 8)){
            
            array_push($erreurs, "le mot de passe doit contenir 8 caracteres");
        }
        if (!empty($erreurs)) {
            echo "<ul>";
            foreach ($erreurs as $erreur) {
                echo "<li style='color: red;'>$erreur</li>";
            }
            echo "</ul>";
        }else{
            if($mot_de_passe === $confirmation_mot_de_passe){

                $email_exist= "SELECT COUNT(*) FROM utilisateurs WHERE email = ?";
                $verif_email_exist= $db->prepare($email_exist);
                $verif_email_exist->execute([$email]);
                $count_email_exist = $verif_email_exist->fetchColumn();

                if($count_email_exist === 0){
                    $mot_de_passe= md5($_POST['mot_de_passe']);
                    $confirmation_mot_de_passe= md5($_POST['confirmation_mot_de_passe']);
                    $insertion= "INSERT INTO utilisateurs(nom_utilisateur, email, mot_de_passe) values (?, ?, ?)";
                    $stmt=$db->prepare($insertion);
                    $stmt->execute([$nom, $email, $mot_de_passe]);
                    echo "inscription bien reussie";
                }else{
                    echo "<li style='color: red;'>Cet e-mail est déjà enregistré.</li>";
                }
                
            }else{
                echo "<li style='color: red;'>Veuillez saisir le même mot de passe.</li>";
            }
            
        }
    }

    if(isset($_POST["se_connecter"])){
        $email= $_POST['email'];
        $mot_de_passe= md5($_POST['mot_de_passe']);

        $connexion="SELECT * FROM utilisateurs WHERE email = ? AND mot_de_passe = ?";
        $stmt=$db->prepare($connexion);
        $stmt->execute([$email, $mot_de_passe]);
        $user=$stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            header('location: connexion.php');
        }else{
            echo "echec de connexion";
        }

    }
    
}



?>