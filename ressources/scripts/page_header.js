
function updateWelcomeMessage( ){
    $("#welcomeMsg").html( HTMLEncode( "Bienvenue " + getUsername()));
}

verifyToken( 
    function(){
        $(document).ready( function( ){
            $("#logged_in").show();
            $("#not_logged_in").hide();
            updateUser( function(){
                updateWelcomeMessage();
            });
        });
    },
    function(){
        $(document).ready( function(){
            $("#logged_in").hide();
            $("#not_logged_in").show();
        });
    }
);

$(document).ready( function( ){
    $("#login").click( function(){
        username = $("#login_username").val();
        password = $("#login_password").val();
        login( username, password, function(){
            document.getElementById('login_page').style.display='none';
            $("#logged_in").show();
            $("#not_logged_in").hide();
            updateWelcomeMessage();
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
    });
});