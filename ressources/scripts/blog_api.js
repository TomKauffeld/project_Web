_api_base_url = "https://pubflare.ovh/school/blog/api";
_api_version = "latest";
_api_url = this._api_base_url + "/" + this._api_version;

function _getToken( url, username, password, onSuccess, onFailure){
    send( url, "POST", "{\"username\":\""+username+"\",\"password\":\""+password+"\"}", function( json){
        if (json.status == "OK" && json.loggedIn){
            store( "token", JSON.stringify( json.token));
            store( "user", JSON.stringify( json.user));
            if (onSuccess != null)
                onSuccess();
        }else{
            if (onFailure != null)
                onFailure();
        }
    });
}

function getUsername( ){
    var user = load( "user");
    if (user.length > 0 && user != "undefined"){
        var json = JSON.parse( user);
        return json.username;
    }else{
        return "";
    }
}

function logout(){
    remove( "token");
    remove( "user");
}

function hasToken( ){
    if (getToken()){
        return true;
    }else{
        return false;
    }
}

function login( username, password, onSuccess = null, onFailure = null){
    _getToken( _api_url + "/auth/login", username, password, onSuccess, onFailure);
}

function createAccount( username, password, onSuccess = null, onFailure = null){
    _getToken( _api_url + "/user", username, password, onSuccess, onFailure);
}

function verifyToken( onSuccess = null, onFailure = null){
    if (getToken()){
        send( _api_url + "/auth/validate", "POST", "{\"token\":"+getToken()+"}", function( json){
            if (json.status == "OK" && json.valid){
                if (onSuccess != null)
                    onSuccess();
            }else{
                if (onFailure != null)
                    onFailure();
            }
        });
    }else{
        if (onFailure != null)
            onFailure();
    }
}

function getToken( ){
    return load( "token");
}

function getId( ){
    var token = getToken();
    if (token.length > 0 && token != "undefined"){
        var json = JSON.parse( token);
        return json.id;
    }else{
        return "";
    }
}

function getAdminLvL( ){
    var user = load( "user");
    if (user.length > 0 && user != "undefined"){
        var json = JSON.parse( user);
        return json.adminLvL;
    }else{
        return -1;
    }
}

function updateUser( onSuccess = null, onFailure = null){
    send( _api_url + "/user/" + getId(), "GET", null, function( json){
        if (json.status == "OK"){
            store( "user", JSON.stringify( json.user));
            if (onSuccess != null)
                onSuccess();
        }else{
            if (onFailure != null)
                onFailure();
        }
    });
}

function getCategories( ){
    var categories_ids = load( "categories_ids", false);
    if (!categories_ids)
        return null;
    var json_ids = JSON.parse( categories_ids);
    var categories = new Array( json_ids.lenght);
    var i = 0;
    json_ids.categories.forEach( element =>{
        categories[i] = JSON.parse( load( "category_" + element, false));
        i++;
    });
    return categories;
}

function getNbCategories( ){
    var categories_ids = load( "categories_ids", false);
    if (!categories_ids)
        return 0;
    var json_ids = JSON.parse( categories_ids);
    return json_ids.lenght;
}

function updateCategories( onSuccess = null, onFailure = null){
    send( _api_url + "/category", "GET", null, function( json){
        if (json.status == "OK"){
            store( "categories_ids", JSON.stringify( json), false);
            _updateCategory( json.categories, 0, json.length, onSuccess);
        }else{
            if (onFailure != null)
                onFailure();
        }
    });
}

function _updateCategory( list, i, max, onSuccess = null, onFailure = null){
    if (i >= max || list[i] == "undefined" || list[i] == undefined){
        if (onSuccess != null)
            onSuccess();
        return;
    }
    console.log( i + "  " + max);
    send( _api_url + "/category/" + list[i], "GET", null, function( json){
        if ( json.status == "OK")
            store( "category_" + list[i], JSON.stringify(json.category), false);
        _updateCategory( list, i+1, max, onSuccess, onFailure);
    });
}