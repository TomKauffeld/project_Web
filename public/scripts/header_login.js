function menu_deco( ){
    $("#button_login").show();
    $("#button_create").show();
    $("#button_deco").hide();
}

//tmp function
function isLoggedIn( yesFunction, noFunction){
    noFunction();
}


isLoggedIn(
    function(){
        $(document).ready( function(){
            $("#button_login").hide();
            $("#button_create").hide();
            $("#button_deco").show();
        })
    },
    function(){
        $(document).ready( function(){
            $("#button_login").show();
            $("#button_create").show();
            $("#button_deco").hide();
        })
}
);