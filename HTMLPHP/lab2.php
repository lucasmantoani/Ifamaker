<?php session_start();
require_once "class.php";
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="../CSS/modifyForm.css">
<!------ Include the above in your HEAD tag ---------->
<?php 
$user = new User();
$user->userModification();
$user2 = new User();
?>
<div class="container " style="padding-top: 60px;">
  <h1 class="page-header" id="title" >Éditez le profil </h1>
  <div class="row">
    <!-- left column -->
    <div class="col-lg-12 ">

    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info ">
      <h3 id="text">Informations personnelles</h3>
      
      <form class="form-horizontal" role="form" method="POST" action="lab2.php">
        <div class="form-group">
          <label class="col-lg-3 control-label " id="text">Prénom:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?= $user2->getUserSurname() ?>" type="text" name="prenom">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label " id="text">Nom</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?= $user2->getUsername() ?>" type="text" name="nom">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label" id="text" >Email:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?= $user2->getUserEmail() ?>" type="text" name="mail">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label" id="text">Pseudo:</label>
          <div class="col-md-8">
            <input class="form-control" value="<?= $user2->getUserPseudo() ?>" type="text" name="pseudo">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label" id="text">Mot de passe:</label>
          <div class="col-md-8">
            <input class="form-control" value="" type="password" name="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label" id="text">Confirmez le mot de passe:</label>
          <div class="col-md-8">
            <input class="form-control" value="" type="password" name="password2">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label" id="text"></label>
          <div class="col-md-8">
            <?php include "Modules/modificationForm.html"; ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

