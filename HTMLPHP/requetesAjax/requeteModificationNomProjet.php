<?php 
    ini_set('display_errors', 1);
    include "../class.php";
    $bdd = BDD();


    $id_utilisateur = $_SESSION['id_utilisateur'];
    $id = htmlspecialchars($_POST['id_projet']);
    $nom = htmlspecialchars($_POST['nom']);

    if($nom != null) 
    {
        $result = $bdd->prepare('UPDATE projet SET nom= ? WHERE id_projet = ? ');
        $result->execute(array($nom, $id));
    
        echo $id . ' id tab<br>';
        echo $id_utilisateur . ' id user<br>';
        echo $nom . '  nom<br>';
    }
