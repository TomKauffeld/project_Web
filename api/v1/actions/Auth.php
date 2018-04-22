<?php
header('Content-Type: application/json');
header( "Access-Control-Allow-Origin: *");
require_once __DIR__."/../managers/TokenManagement.php";
require_once __DIR__."/../managers/UserManagement.php";
require_once __DIR__."/../objects/User.php";
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        $request = json_decode( file_get_contents( 'php://input'), true);
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if (($i+3 == $lenght || $i+4 == $lenght || $i+5 == $lenght) && ($url_arr[$i+2] == "auth") && !(isset( $url_arr[$i+4]) && strlen( $url_arr[$i+4]) > 0)){
            switch ($url_arr[$i+3]) {
                case "validate":
                    if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                        if (isset( $request["token"]) && count($request["token"]) > 0){
                            $user = TokenManagement::checkTokenJson( $request["token"]);
                            if ($user == null){
                                echo json_encode( array( "status" => "OK", "valid" => false, "version" => "v1"));
                            }else{
                                echo json_encode( array( "status" => "OK", "valid" => true, "version" => "v1"));
                            }
                        }else{
                            include __DIR__."/ErrorParams.php";
                        }
                    }else{
                        http_response_code( 505);
                        echo json_encode( array( "status" => "ERROR", "error" => "NOT A SECURE CONNECTION", "version" => "v1"));
                    }
                    break;
                case "login":
                    if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                        if (isset( $request["username"]) && isset( $request["password"]) && strlen( $request["username"]) > 0 && strlen( $request["password"]) > 0){
                            echo json_encode(UserManagement::loginWithPassword( $request["username"], $request["password"]));
                        }else{
                            include __DIR__."/ErrorParams.php";
                        }
                    }else{
                        http_response_code( 505);
                        echo json_encode( array( "status" => "ERROR", "error" => "NOT A SECURE CONNECTION", "version" => "v1"));
                    }
                    break;
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