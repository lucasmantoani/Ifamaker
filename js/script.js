$(function() {

    // Drag and Drop des billets entre les colonnes

    $( ".sortable" ).sortable({   // On vise la classe .sortable et on utilise la méthode sortable()
      connectWith: ".connectedSortable", // .connectedSortable est la classe qui contient les billets, à l'intérieur de la colonne
      receive: function( event, ui ) {
        $(this).css({"background-color":"gray"}); // Lors d'un event, le fond devient gris !
      }
    }).disableSelection(); 

    // Création des nouveaux billets grâce au formulaire
    $('.add-button').click(function() {
        var txtNewItem = $('#new_text').val();
        $(this).closest('div.container').find('ul').append('<li class="card">'+txtNewItem+'</li>');
        // Quand on clique sur le bouton add, on donne la valeur entrée à la variable txtNewItem
        // Et dans le div.container le plus proche, on trouve l'ul et on met dedans un li avec le texte de la variable

        // ********* A FAIRE ICI : REQUETE AJAX AJOUT BILLET BDD ************
    });   
    
    $( ".all" ).sortable({   // On vise la classe .all et on utilise la méthode sortable()
      connectWith: ".container", // .container est la classe qui contient les billets, à l'intérieur du body.
      receive: function( event, ui ) {
        $(this).css({"background-color":"gray"}); // Lors d'un event, le fond devient gris !
      }
    }).disableSelection(); 



  });