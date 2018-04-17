function updateWelcomeMessage( ){
    $("#welcomeMsg").html( HTMLEncode( "Welcome " + getUsername()));
}
$("#login").click( function(){
    username = $("#username").val();
    password = $("#password").val();
    login( username, password, function(){
        $("#logged_in").show();
        $("#not_logged_in").hide();
        updateWelcomeMessage();
    }, function(){

    })
});
$("#create").click( function(){
    username = $("#username").val();
    password = $("#password").val();
    createAccount( username, password, function(){
        $("#logged_in").show();
        $("#not_logged_in").hide();
        updateWelcomeMessage();
    }, function(){

    })
});
$("#logout").click( function(){
    setCookie( "token", null, 0);
    setCookie( "user", null, 0);
    $("#logged_in").hide();
    $("#not_logged_in").show();
});
if (hasToken()){
    verifyToken( load("token"), function(){
        $("#loading").hide();
        $("#logged_in").show();
        $("#not_logged_in").hide();
        updateWelcomeMessage();
    }, function(){
        $("#loading").hide();
        $("#logged_in").hide();
        $("#not_logged_in").show();
    })

}else{
    $("#loading").hide();
    $("#logged_in").hide();
    $("#not_logged_in").show();
}

function getUsername( ){
    var user = load( "user");
    if (user.length > 0){
        json = JSON.parse( user);
        return json.username;
    }else{
        return "";
    }
}

