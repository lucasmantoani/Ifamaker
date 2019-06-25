<?php 
    ini_set('display_errors', 1);
    include "../class.php";
    $bdd = BDD();


    $id = htmlspecialchars($_POST['id_tableau']);
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $nom = htmlspecialchars($_POST['nom']);

    if($nom != null) 
    {
        $result = $bdd->prepare('UPDATE tableau SET nom= ? WHERE id_tableau = ? AND id_utilisateur = ? ');
        $result->execute(array($nom, $id, $id_utilisateur));
    
        echo $id . ' id tab<br>';
        echo $id_utilisateur . ' id user<br>';
        echo $nom . '  nom<br>';
    }
