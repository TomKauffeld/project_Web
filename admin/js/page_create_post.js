verifyToken( 
    function(){
        updateUser( function(){
            if (getAdminLvL()>=1){
                $(document).ready( function( ){
                    $("#create_post").show();
                });
            }
        });
    }
);

function getBase64( file){
    return new Promise( function( resolve, reject){
        var reader = new FileReader();
        reader.onload = function( ) { resolve( reader.result);};
        reader.onerror = reject;
        reader.readAsDataURL( file);
    });
}

$(document).ready( function(){
    $("#form_post_button").click( function( ){
        var promise = getBase64( document.getElementById( "form_post_image").files[0]);
        promise.then( function( result){
            var sendData = {
                "base64": result.split("base64,").pop(),
                "type": $("#form_post_image").val().split('.').pop(),
                "title": $("#form_post_title").val(),
                "body": $("#form_post_body").val(),
                "token": JSON.parse(getToken()),
                "categories": $("#form_post_categories").val()
            }
            var sendString = JSON.stringify( sendData);
            send( "https://pubflare.ovh/school/blog/api/latest/post", "POST", sendString, function( json){
                alert( JSON.stringify( json));
            });
        });
    });
});