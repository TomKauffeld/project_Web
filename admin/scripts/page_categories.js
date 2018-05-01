  
  function addCategoryToList( name, nb){
      $(document).ready( function(){
          $("#list_categories").append(
              "<tr><td>" + HTMLEncode( name) + "</td><td>" + nb + "</td><td><a href=\"#\" alt=\"Modifier la categorie\" class=\"icon-edit\"><i class=\"fa fa-pencil\"></i></a></td><td><a href=\"#\" alt=\"Supprimer la categorie\" class=\"icon-delete\"><i class=\"fa fa-times\"></i></a></td></tr>"
          );
  
  
  
      });
  }
  
send( _api_url + "/category", "GET", null, function( json){
    json.categories.forEach(element => {
        send( _api_url + "/category/" + element, "GET", null, function( response){
            var name  = response.category.name;
            send( _api_url + "/category/" + element + "/posts", "GET", null, function( rep){
                var nb = rep.lenght;
                addCategoryToList( name, nb);
            })
        });
    });


});

$(document).ready( function(){
    $("#addCategorie").click( function( ){
        var token = getToken();
        var name = $("#inputCat").val();
        var sendData = {
            "name": name,
            "token": JSON.parse( token)
        };
        var sendString = JSON.stringify( sendData);
        send( "https://pubflare.ovh/school/blog/api/latest/category", "POST", sendString, function( json){
            if (json.status == "OK"){
                location.reload();
            }else{
                alert( json.error);
            }
        });
    });
});