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
        onFailure();
    }
}

function getToken( ){
    return load( "token");
}

function getId( ){
    var token = getToken();
    var json = JSON.parse( token);
    return json.id;
}

function updateUser( onSuccess = null, onFailure = null){
    send( _api_url + "/user/" + getId());
}