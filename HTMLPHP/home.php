<?php 

require_once "class.php";
?>
<!doctype html>
<html lang="fr">
  <head>
    <title>Espace utilisateur</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/home.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://kit.fontawesome.com/7e4d904d0f.js"></script>
  </head>
  <body>
    <?php 
      include 'header.php'; 
      require "./Modules/deconnection.html";
      ?>
    <h1 id='title'>Espace utilisateur</h1>
    <div class="container">
      <div class="row">
        <div class="col">
          <?php 
      include "lab.php";
      ?>
      </div>
      <div class="col">
      <div class="card">
        <div class="card-body bg-dark">
          <?php 
          $tab = new Tableau();
          $tab->getProjet();
          require "./modales/modalCreationTableau.php";

        ?>
        </div>
        <?php require "./modales/modalCreationProjet.php"; ?>
      </div>
    </div>
    </div>
  </div>
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="../js/modal.js"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
  </body>
</html>
<!doctype html>
