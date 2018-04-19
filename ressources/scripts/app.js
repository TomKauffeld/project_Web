var post_body = $("#posts").html();
$("#posts").empty();
var post_document = document.implementation.createHTMLDocument("");
var div = post_document.createElement( "div");
div.innerHTML = post_body;
post_document.body.appendChild( div);


function addPost( title, date, body, nb){
    post_document.getElementById( "post_title").innerHTML = title;
    post_document.getElementById( "post_date").innerHTML = date;
    post_document.getElementById( "post_body").innerHTML = body;
    post_document.getElementById( "post_comments").innerHTML = nb;
    document.getElementById( "posts").innerHTML += post_document.body.innerHTML;
}

addPost( "test", "25/45/2015", "the body", 0);
addPost( "test", "25/45/2015", "the body", 0);
addPost( "test", "25/45/2015", "the body", 0);

function updateWelcomeMessage( ){
    $("#welcomeMsg").html( HTMLEncode( "Bienvenue " + getUsername()));
}
$("#login").click( function(){
    username = $("#login_username").val();
    password = $("#login_password").val();
    login( username, password, function(){
        document.getElementById('login_page').style.display='none';
        $("#logged_in").show();
        $("#not_logged_in").hide();
        updateWelcomeMessage();
        var user = JSON.parse( load( "user"));
        if (user.adminLvL >= 1){
            $("#create_post").show();
            $("#not_create_post").hide();
        }else{
            $("#create_post").hide();
            $("#not_create_post").show();
        }
    }, function(){

    })
});
$("#create").click( function(){
    username = $("#create_username").val();
    password = $("#create_password").val();
    createAccount( username, password, function(){
        document.getElementById('create_page').style.display='none';
        $("#logged_in").show();
        $("#not_logged_in").hide();
        updateWelcomeMessage();
    }, function(){

    })
});
$("#logout").click( function(){
    logout();
    $("#logged_in").hide();
    $("#not_logged_in").show();
    $("#create_post").hide();
    $("#not_create_post").show();
});



function getUsername( ){
    var user = load( "user");
    if (user.length > 0){
        json = JSON.parse( user);
        return json.username;
    }else{
        return "";
    }
}

$(document).ready( function( ){
    verifyToken( function(){
        $("#logged_in").show();
        $("#not_logged_in").hide();
        updateUser( function(){
            updateWelcomeMessage();
            var user = JSON.parse(load( "user"));
            if (user.adminLvL >= 1){
                $("#create_post").show();
                $("#not_create_post").hide();
            }else{
                $("#create_post").hide();
                $("#not_create_post").show();
            }
        })
    },
    function(){
        $("#logged_in").hide();
        $("#not_logged_in").show();
        $("#create_post").hide();
        $("#not_create_post").show();
    }
);

    updateCategories( function( ){
        var nb = getNbCategories();
        var categories = getCategories();
        document.getElementById( "create_post_categories").innerHTML = "";
        document.getElementById( "create_post_categories").setAttribute( "size", nb);
        for (let index = 0; index < categories.length; index++) {
            const element = categories[index];
            document.getElementById( "create_post_categories").innerHTML += '<option value="' + element.id + '">' + element.name + '</option>';
        }
    })
})
