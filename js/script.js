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
  
    
     $( ".all" ).sortable({   
      connectWith: ".container", 
      receive: function( event, ui ) {
        $(this).css({"background-color":"gray"}); 
      }
    }).disableSelection(); 

// Fonction permettant la sauvegarde de la position des cartes :

    $(".card").click(function() {
      var cardId = $(this).attr("id_billet");
      var colId = $(this).parent().parent().attr("id_colonne");

        $.ajax({
            url: '../HTMLPHP/requetesAjax/postRequest.php',
            type: 'POST',
            data: 'id_colonne=' + colId + '&id_billet=' + cardId,
            success: function(data){
                //console.log("Bien joué bg");
            },
            error: function(data){
               
            }
        });

        event.stopPropagation();
    }); 

// Fonction de suppression des cartes en AJAX :

    $(".deleteCard").hover().css("color","orange");
    $(".deleteCard").click(function() {

      var cardId = $(this).parent().attr("id_billet");
      
      $.ajax({
        url: '../HTMLPHP/requetesAjax/requeteSuppression.php',
        type: 'POST',
        data: '&id_billet=' + cardId,
        success: function(data)
        {
            $('[id_billet="'+ cardId +'"]').fadeOut();

        },
        error: function(data)
        {
           alert('Erreur lors de la suppression, veuillez réessayer');
        }
    });
    })

    // Fonction de suppression des colonnes en AJAX :

    $(".deleteCol").hover().css("color","orange");
    $(".deleteCol").click(function() {

      var colId = $(this).parent().parent().attr("id_colonne");
      
      $.ajax({
        url: '../HTMLPHP/requetesAjax/requeteSuppColonne.php',
        type: 'POST',
        data: '&id_colonne=' + colId,
        success: function(data)
        {

          $('[id_colonne="'+ colId +'"]').fadeOut();

        },
        error: function(data)
        {
           alert('Erreur lors de la suppression, veuillez réessayer');
        }
    });
    })


      // Fonction de création des tableaux en AJAX:

      $(".boutonCreation").click(function() {
  
        var TabId = $(this).parent().parent().attr("value");
        
        $.ajax({
          url: '../HTMLPHP/requetesAjax/requeteSuppColonne.php',
          type: 'POST',
          data: '&id_colonne=' + colId,
          success: function(data)
          {
  
            $('[id_colonne="'+ colId +'"]').fadeOut();
  
          },
          error: function(data)
          {
              alert('Erreur lors de la suppression, veuillez réessayer');
          }
      });
      })






  });