<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/contact.css">
    <title>Contact</title>
</head>
<body>
<?php include 'header.php'; ?>
<h1 id='title' >Contact</h1>
<div class="container-fluid py-3">
    <form id="contact-form" method="post" action="contact.php" role="form">
        <div class="messages"></div>
        <div class="controls">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group text-warning">
                        <label for="form_name">Nom *</label>
                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Veuillez entrer votre nom *" required="required" data-error="name is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group text-warning">
                        <label for="form_email">Email *</label>
                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Veuillez entrer votre adresse mail *" required="required" data-error="Valid email is required.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group text-warning">
                        <label for="form_phone">Téléphone</label>
                        <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Veuillez entrer votre numéro de téléphone">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group text-warning">
                    <label for="form_message">Message *</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Message *" rows="4" required="required" data-error="send a message."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-warning btn-send" value="Envoyer">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted text-warning"><strong>*</strong> Champs requis.</p>
            </div>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>