<?php 
    ini_set('display_errors', 1);
    include "../class.php";
    $bdd = BDD();


echo 'Colonne: ' . $_POST['id_colonne'] . "<br>";
echo 'Billet: ' . $_POST['id_billet'];

$id_colonne = htmlspecialchars($_POST['id_colonne']);
$id_billet = htmlspecialchars($_POST['id_billet']);

if($id_colonne != 'NULL' && $id_billet != 'NULL') 
{
    $insertmbr = $bdd->prepare("UPDATE billets SET id_colonne= ? WHERE id_billets= ?"); // ? = Marqueur de positionement
    $insertmbr->execute(array($id_colonne, $id_billet));
    var_dump($insertmbr);
}
?>
    
