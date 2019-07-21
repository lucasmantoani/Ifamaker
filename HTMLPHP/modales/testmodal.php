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

    </style>
  </head>
  <?php
      $tableau = new Tableau();
      $tableau->creationBillet()
  ?>

  <body>
      <button type="button" class=" bruh btn btn-lg btn-success">Création d'un billet</button>
      <div class="modal" id="infos">
        <div class="modal-dialog bg-light text-dark">
          <div class="modal-content bg-light text-dark">
            <div class="modal-header bg-light">
              <h4 class="modal-title text-dark">Créer un billet</h4>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body bg-light text-dark">
              Attention : Le billet sera automatiquement ajouté à la première colonne !
            </div>
            <div>
              <form style="margin-left: 10px;" method="POST">

                <div class="row">
                  <div class="col-sm-12">
                    <div class="inputBox bg-light text-dark ">
                      <div class="inputText">Titre</div>
                      <input type="text" name="titre" class="input">
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="inputBox bg-light text-dark">
                      <div  class="inputText">Description</div>
                      <TEXTAREA style="margin-left: 10px;" name="description" rows=3 cols=40></TEXTAREA>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="inputBox bg-light text-dark">
                      <div class="inputText">Priorité (Basse, Normale, Haute)</div>
                      <input type="text" name="priorité" class="input">
                    </div>
                  </div>

                  <div class="modal-footer bg-light text-dark" style="margin-left: 10px;">
                    <input type="submit" name="boutonCreation" class="btn btn-success"></input>
                    <button type="button" name="boutonQuitter" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                  </div>
              </form>

            </div>
          </div>
        </div>
      </div>
      <script>
          $('.btn').click(function()
          {
          $('.modal').modal('show')
          });
      </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/modal.js"></script>
  </body>
</html>
