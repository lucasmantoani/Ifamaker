<?php
ini_set('display_errors', 1);
$user = new User();
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="../CSS/home.css">
<!------ Include the above in your HEAD tag ---------->
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-12">
            <div class="well well-sm bg-dark">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4><?= $user->getUserSurname() ?> <?= $user->getUsername() ?></h4>
                        <small>
                          <h4 title="pseudo"> pseudo : <?= $user->getUserPseudo() ?></h4>
                        </small>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i> <?= $user->getUserEmail() ?><br>
                            <i class="glyphicon glyphicon-gift"></i> <?= $user->getUserAge() ?> ans<br>
                            <i class="glyphicon glyphicon-chevron-right"></i> Inscription : <?= $user->getUserSignupDate() ?>
                        </p>  
                        <?php include "./Modules/modifyButton.html";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>