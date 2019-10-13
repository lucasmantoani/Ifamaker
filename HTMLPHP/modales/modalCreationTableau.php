<!doctype html>
<html lang="fr">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
    .bruh {
      margin-top: 10px;
      margin-left: 20px;
    }
    .modal {
      margin-right: 200px;
    }

    </style>
  </head>
  <?php
      $tableau = new Tableau();
  ?>

  <body>
      <button type="button" class=" bruh btn btn-lg btn-success btn-crea2 ">Création d'un tableau </button>
      <div class="modal modal-tableau" id="infos">
        <div class="modal-dialog">
          <div class="modal-content bg-light">
            <div class="modal-header bg-light">
              <h4 class="modal-title text-dark">Création tableau</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>            
            </div>
            <div>
              <form style="margin-left: 10px;" method="POST">
    
                <div class="row">
                  <div class="col-sm-12">
                    <div class="inputBox bg-light ">
                      <div class="inputText">Titre</div>
                      <input type="text" name="titre" class="input">
                    </div>
                  </div>
    
                  <div class="col-sm-12">
                    <div class="inputBox">
                      <div  class="inputText">Projet</div>
                      <select name="projet" id="">
                        <?php $tableau->getProjets() ?>
                      </select>
                    </div>
                  </div>
                </div>
    
                <div class="row">
                  <div class="col-sm-12">
                    <div class="inputBox">
                    </div>
                  </div>
    
                  <div class="modal-footer" style="margin-left: 10px;">
                    <input type="button" value="Créer" name="boutonCreation" class="btn btn-success boutonCreation"></input>
                    <button type="button" name="boutonQuitter" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                  </div>
              </form>     
            </div>
          </div>
        </div>
      </div>

      <script>
        $('.btn-crea2').click(function() 
        {
          $('.modal-tableau').modal('show');
          });

            $(".boutonCreation").click(function() 
            {
              var idProjet = $('select').val();
              var nom = $('input').val()

              $.ajax({
                url: '../HTMLPHP/requetesAjax/requeteCreationTableau.php',
                type: 'POST',
                data: '&id_projet=' + idProjet + '&nom=' + nom ,
                success: function(data){
                  
                  $('.modal-nom').modal('toggle');
                  console.log("envoi ok");
                  document.location.href="home.php";
                },
                error: function(data){
                  alert('Erreur lors de la création, veuillez réessayer');
                }       
            });
          });
      </script> 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="http://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
  </body>
</html>