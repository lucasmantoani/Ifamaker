<?php session_start();
require_once "class.php";
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="contact.css">
<!------ Include the above in your HEAD tag ---------->
<?php 
$user = new User();
$user->userModification();

$user2 = new User();

?>
<div class="container " style="padding-top: 60px;">
  <h1 class="page-header">Éditez le profil </h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="http://lorempixel.com/200/200/people/9/" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Téléchargez une photo..</h6>
        <input type="file" class="text-center center-block well well-sm">
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <h3>Informations personnelles</h3>
      <form class="form-horizontal" role="form" method="POST" action="lab2.php">
        <div class="form-group">
          <label class="col-lg-3 control-label">Prénom:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?= $user2->getUserSurname() ?>" type="text" name="prenom">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Nom</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?= $user2->getUsername() ?>" type="text" name="nom">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?= $user2->getUserEmail() ?>" type="text" name="mail">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Pseudo:</label>
          <div class="col-md-8">
            <input class="form-control" value="<?= $user2->getUserPseudo() ?>" type="text" name="pseudo">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Mot de passe:</label>
          <div class="col-md-8">
            <input class="form-control" value="" type="password" name="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Confirmez le mot de passe:</label>
          <div class="col-md-8">
            <input class="form-control" value="" type="password" name="password2">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <?php include "Modules/modificationForm.html"; ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
