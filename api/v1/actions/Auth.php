<?php
header('Content-Type: application/json');
require_once __DIR__."/../managers/TokenManagement.php";
require_once __DIR__."/../managers/UserManagement.php";
require_once __DIR__."/../objects/User.php";
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if (($i+3 == $lenght || $i+4 == $lenght || $i+5 == $lenght) && ($url_arr[$i+2] == "auth") && !(isset( $url_arr[$i+4]) && strlen( $url_arr[$i+4]) > 0)){
            switch ($variable) {
                case "validate":
                    if (isset( $_POST["token"]) && strlen( $_POST["token"]) > 0){
                        $user = TokenManagement::checkTokenString( $_POST["token"]);
                        if ($user == null){
                            return json_encode( array( "status" => "OK", "valid" => false));
                        }else{
                            return json_encode( array( "status" => "OK", "valid" => true));
                        }
                    }else{
                        include __DIR__."/ErrorParams.php";
                    }
                    break;
                case "login":
                    if (isset( $_POST["username"]) && isset( $_POST["password"]) && strlen( $_POST["username"]) > 0 && strlen( $_POST["password"]) > 0){
                        return UserManagement::loginWithPassword( $_POST["username"], $_POST["password"]);
                    }else{
                        include __DIR__."/ErrorParams.php";
                    }
                default:
                    include __DIR__."/ErrorRequest.php";
                    break;
            }
        }else{
            include __DIR__."/ErrorRequest.php";
        }
        break;
    default:
        include __DIR__."/ErrorRequest.php";
        break;
}