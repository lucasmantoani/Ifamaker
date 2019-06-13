<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  wxdfxbxd
    <?php // Page servant à la déconnexion de l'utilisateur en cliquant sur un bouton dans son espace personnel.                                
    include 'header.php';

    session_destroy();
    ?>
    <script>
      document.location.href="index.php";
    </script>

  </body>
</html>
