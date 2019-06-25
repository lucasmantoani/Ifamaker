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
      <div class="modal modal-confirmation" id="infos">
        <div class="modal-dialog">
          <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
              <h4 class="modal-title text-white">Supprimer un tableau </h4>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>            
            </div>
            <div>
              <form style="margin-left: 10px;" method="POST">
    
                <div class="row">
                  <div class="col-sm-12">
                    <div class="inputBox bg-dark ">
                      <div class="inputText">Etes-vous bien sur de vouloir supprimer ce tableau ? Cette action est irréversible
                      et entrainera la perte des données contenues dans le tableau.</div>
                    </div>
                  </div>
    
                  <div class="modal-footer" style="margin-left: 10px;">
                    <input type="button" value="modifier" name="boutonModification" class="btn btn-success boutonSuppression"></input>
                    <button type="button" name="boutonQuitter" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                  </div>
              </form>
              <!-- <?php //$tableau->modificationNomProjet(); ?> -->

            </div>
          </div>
        </div>
      </div>

      <script>
        $(function() {
          var tabId;

          $('.fa-trash-alt').click(function() 
          {
            var tabId = $(this).attr("id");
            console.log(tabId);
            newTab = tabId;
            return newTab
          });

          // Fonction de modification des noms de tableaux en AJAX :
          $(".boutonSuppression").click(function() {

            $.ajax({
              url: '../HTMLPHP/requetesAjax/requeteSuppressionTableau.php',
              type: 'POST',
              data: '&id_tableau=' + newTab,
              success: function(data){
                
                $('.modal-nom').modal('toggle');
                console.log("envoi ok");
              },
              error: function(data){
                alert('Erreur lors de la suppression, veuillez réessayer');
              }
            });
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