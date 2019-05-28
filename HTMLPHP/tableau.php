<?php ini_set('display_errors', 1);
    require_once 'class.php';
 ?>
<!doctype html>
<html lang="fr">
  <head>
    <title>IFA Maker</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css"/>
    <link rel="stylesheet" href="../CSS/tableau.css" />
    <script src="../js/script.js"></script>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <div class="all">
    <?php 
        $cards = new Tableau ;
        $cards->getColonne();
        $cards->creationColonne();
    ?>
    </div>
    <footer>
      <footer class="page-footer font-small blue">
      <div class="footer-copyright text-center py-3 bg-dark">
      <?php
        $cards = new Tableau ;
        $cards->suppressionTableau(); 
        //$cards->creationColonne();
       ?>
      </div>
      </footer>
    </footer>
  </body>
</html>
