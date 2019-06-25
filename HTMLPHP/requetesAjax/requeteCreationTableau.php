<?php 
    ini_set('display_errors', 1);
    include "../class.php";
    $bdd = BDD();

        $nom = htmlspecialchars($_POST['nom']);
        $projet = $_POST['id_projet'];
        $user = $_SESSION['id_utilisateur'];

        if($nom != null) 
        {

            $requser = $bdd->prepare("INSERT INTO tableau(nom, id_projet, id_utilisateur) VALUES (?,?,?)");
            $requser->execute(array($nom, $projet, $user));
        }
        