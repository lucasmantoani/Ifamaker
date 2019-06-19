<?php 
    ini_set('display_errors', 1);
    include "../class.php";
    $bdd = BDD();

echo 'Billet: ' . $_POST['id_billet'];

$id_billet = htmlspecialchars($_POST['id_billet']);

if($id_billet != 'NULL') 
{
    $insertmbr = $bdd->prepare("DELETE FROM billets WHERE id_billets = ?"); // ? = Marqueur de positionement
    $insertmbr->execute(array($id_billet));
    
}
?>
    
