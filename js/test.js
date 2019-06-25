$.ajax({
  url: '../HTMLPHP/requetesAjax/requeteModificationNomTableau.php',
  type: 'POST',
  data: '&id_tableau=' + newTab,
  success: function(data){
  },
  error: function(data){
  }
});