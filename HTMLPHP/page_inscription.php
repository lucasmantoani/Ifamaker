<?php 
	ini_set('display_errors', 1);
	require_once 'class.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/con-insc.css">
    <title>Inscription</title>
</head>
<body>
<?php include "header.php"; ?>
    <h1 class="mainTitle">Inscription</h1>
    <div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <!-- form card login with validation feedback -->
                    <div class="card card-outline-secondary bg-light">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="loginForm" novalidate="" method="POST">
								<div class="form-group">
									<label for="uname1">Nom</label>
                                    <input type="text" class="form-control" name="nom" id="nom" required="">
                                    <div class="invalid-feedback">Please enter your Name</div>
                                </div>
                                <div class="form-group">
									<label for="uname1">Prénom</label>
                                    <input type="text" class="form-control" name="prenom" id="prenom" required="">
                                    <div class="invalid-feedback">Please enter your surname</div>
                                </div>
								<div class="form-group">
									<label for="uname1">Pseudo</label>
									<input type="text" class="form-control" name="pseudo" id="pseudo" required="">
									<div class="invalid-feedback">Please enter your Pseudo</div>
								</div>
								<div class="form-group">
									<label for="uname1">Age</label>
									<input type="text" class="form-control" name="age" id="age" required="">
									<div class="invalid-feedback">Please enter your Age</div>
								</div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" class="form-control" name="motdepasse" id="motdepasse" required="" autocomplete="new-password">
                                    <div class="invalid-feedback">Please enter a password</div>
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" class="form-control" name="email" id="email" required="" autocomplete="new-password">
                                    <div class="invalid-feedback">Please enter a email</div>
                                </div>
                                <button type="submit" name="submit1" class="btn btn-lg btn-success btn-block" id="btnLogin">Connexion</button>
                                <p class="message">Déjà inscrit ? <a href="page_connexion.php">Connectez vous ici !</a></p>
                            </form>
                        </div>
                        <!--/card-body-->
                    </div>
                    <!-- /form card login -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php

	$user = new User ;
	$user->Inscription();
 	include 'footer.php'; 
 ?>
</body>