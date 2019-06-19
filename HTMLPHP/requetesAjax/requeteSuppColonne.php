<?php 
    ini_set('display_errors', 1);
    include "../class.php";
    $bdd = BDD();

echo 'col: ' . $_POST['id_colonne'];

$id_colonne = htmlspecialchars($_POST['id_colonne']);

if($id_colonne != 'NULL') 
{
    $delCol = $bdd->prepare("DELETE FROM colonne WHERE id_colonne = ?"); 
    $delCol->execute(array($id_colonne));
    
    $delCard = $bdd->prepare("DELETE FROM billets WHERE id_colonne = ?"); 
    $delCard->execute(array($id_colonne));
    
}
?>
    
