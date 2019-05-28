$(function() {
  var cardId;
  var colId;
    // Drag and Drop des billets entre les colonnes

    $( ".sortable" ).sortable({   
      connectWith: ".connectedSortable", 
      receive: function( event, ui ) {
        $(this).css({"background-color":"gainsboro"}); 

      }
    }).disableSelection(); 

    // Création des nouveaux billets grâce au formulaire
    $('.add-button').click(function() {
        var txtNewItem = $('#new_text').val();
        console.log(txtNewItem);
        $(this).closest('div.container').find('ul').append('<li class="card">'+txtNewItem+'</li>');
        // Quand on clique sur le bouton add, on donne la valeur entrée à la variable txtNewItem
        // Et dans le div.container le plus proche, on trouve l'ul et on met dedans un li avec le texte de la variable

        // ********* A FAIRE ICI : REQUETE AJAX AJOUT BILLET BDD ************
    });   
    
     $( ".all" ).sortable({   
      connectWith: ".container", 
      receive: function( event, ui ) {
        $(this).css({"background-color":"gray"}); 
      }
    }).disableSelection(); 

    
    $(".card").click(function() {
      var cardId = $(this).attr("id_billet");
      var colId = $(this).parent().parent().attr("id_colonne");
      
      //alert('Billet '+cardId);
      //alert('colonne ' +colId);
      // Appel AJAX pour mettre à jour la la colonne dans laquelle se trouve le billet
        $.ajax({
            url: '../HTMLPHP/postRequest.php',
            type: 'POST',
            data: 'id_colonne=' + colId + '&id_billet=' + cardId,
            success: function(data){
                console.log("Bien joué bg");
            },
            error: function(data){
               
            }//,
            //complete: function(data){}
        });

        event.stopPropagation();
    }); 


  });