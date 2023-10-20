<?php
session_start();
require_once('bd.php');

if (isset($_SESSION['user_nom'])) {
    $nom_utilisateur = $_SESSION['user_nom'];
    echo " <h1>Gestion de mes tâches <br> $nom_utilisateur</h1>";
} else {
    echo 'Vous n\'êtes pas connecté.';
}

$titre= "";
$date_echeance= "";
$priorite= "";
$etat= "";
$description= "";
$id_utlisateur= $_SESSION['user_id'];
$erreurs=[];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["creer_tache"])){
        $id_utlisateur= $_SESSION['user_id'];
        $titre= $_POST["titre"];
        $date_echeance= $_POST["date_echeance"];
        $priorite= $_POST["priorite"];
        $etat= $_POST["etat"];
        $description= $_POST["description"];

        $regex_titre = "/^[a-zA-Z ']{2,}$/";
        if (!preg_match($regex_titre, $_POST["titre"])) {
            array_push($erreurs,"Le champ 'titre' doit contenir uniquement des lettres") ;
        }
       
        
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_echeance)) {
            array_push($erreurs, "Le champ 'date d'échéance' doit être au format 'YYYY-MM-DD'.") ;
        }
        
        if (empty($priorite)) {
            array_push($erreurs, "Veuillez sélectionner une priorité.") ;
        }
        
        if (empty($etat)) {
            array_push($erreurs, "Veuillez sélectionner un etat.") ;

        } 
        if (empty($description)) {
            array_push($erreurs, "Le champ description ne peut pas être vide.") ;

        }
            
        if(!empty($erreurs)){
            echo "<ul>";
            foreach($erreurs as $erreur){
                 echo "<li style='color: red;'>$erreur</li>";
            }
            echo "</ul>";

        }else{
            $insertion = "INSERT INTO taches (id_utilisateur, nom_tache, description, date_echeance, priorite, etat) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($insertion);
            $stmt->execute([$id_utlisateur, $titre, $description, $date_echeance, $priorite, $etat]);
            echo "insertion reussi";
        }
        
    }

}
    
?>