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
      <button type="button" class=" bruh btn btn-lg btn-info btn-crea ">Création d'un projet </button>
      <div class="modal modal-projet" id="infos">
        <div class="modal-dialog">
          <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
              <h4 class="modal-title text-white">Créer un Projet</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>            
            </div>
            <div>
              <form style="margin-left: 10px;" method="POST">
    
                <div class="row">
                  <div class="col-sm-12">
                    <div class="inputBox bg-dark ">
                      <div class="inputText">Titre</div>
                      <input type="text" name="titre" class="input">
                    </div>
                  </div>
    
                <div class="row">
                  <div class="col-sm-12">
                    <div class="inputBox">
                    </div>
                  </div>
    
                  <div class="modal-footer" style="margin-left: 10px;">
                    <input type="submit" name="boutonCreationProjet" class="btn btn-success boutonCreation"></input>
                    <button type="button" name="boutonQuitter" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                  </div>
              </form>
              <?php $tableau->creationProjet(); ?>

            </div>
          </div>
        </div>
      </div>
      <script>
        $('.btn-crea').click(function() {
        $('.modal-projet').modal('show')
      })
      </script>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>