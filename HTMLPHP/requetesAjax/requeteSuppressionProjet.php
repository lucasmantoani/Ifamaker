<?php 
    ini_set('display_errors', 1);
    include "../class.php";
    $bdd = BDD();


    $id = htmlspecialchars($_POST['id_projet']);
    $id_utilisateur = $_SESSION['id_utilisateur']; // ID de session pour pas rentrer n'importe quel ID

    if($id != null) 
    {

        $insertmbr = $bdd->prepare("DELETE FROM projet_utilisateur WHERE id_projet = ? AND id_utilisateur = ? "); // ? = Marqueur de positionement
        $insertmbr->execute(array($id, $id_utilisateur));

        echo $id . ' id tab<br>';
        echo $id_utilisateur . ' id user<br>';

    }
