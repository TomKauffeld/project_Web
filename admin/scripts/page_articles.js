function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp * 1000);
    var year = a.getFullYear();
    var month = a.getMonth();
    var date = a.getDate();
    var time = date + "/" + month + "/" + year;
    return time;
  }
  
  function addPostToList( title, author, date){
      $(document).ready( function(){
          $("#list_posts").append(
              "<tr><td>" + HTMLEncode( title) + "</td><td>" + HTMLEncode( author) + "</td><td>Publié le " + date + "</td><td><a href=\"#\" alt=\"Modifier l'article\" class=\"icon-edit\"><i class=\"fa fa-pencil\"></i></a></td><td><a href=\"#\" alt=\"Supprimer l'article\" class=\"icon-delete\"><i class=\"fa fa-times\"></i></a></td></tr>"
          );
  
  
  
      });
  }
  
send( _api_url + "/post", "GET", null, function( json){
    json.posts.forEach(element => {
        send( _api_url + "/post/" + element, "GET", null, function( response){
            var title  = response.post.title;
            var date  = timeConverter( response.post.time);
            send( _api_url + "/user/" + response.post.author, "GET", null, function( rep){
                var author = rep.user.username;
                addPostToList( title, author, date);
            })
        });
    });


});
