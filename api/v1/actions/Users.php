<?php
require_once __DIR__."/../managers/UserManagement.php";
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        if (isset( $_POST["username"]) && isset( $_POST["password"])){
            if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                echo json_encode( UserManagement::createUser( $_POST["username"], $_POST["password"]));
            }else{
                http_response_code( 505);
                echo json_encode( array( "status" => "ERROR", "error" => "NOT A SECURE CONNECTION", "version" => "v1"));
            }
        }else{
            http_response_code( 400);
            echo json_encode( array( "status" => "ERROR", "error" => "USERNAME OR PASSWORD NOT SET", "version" => "v1"));
        }
        break;
    case "GET":
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if ($i+3 == $lenght || $i+4 == $lenght || $i+2 == $lenght || $i+5 == $lenght){
            if (($url_arr[$i+2] == "user" || $url_arr[$i+2] == "users") && isset( $url_arr[$i+3]) && strlen($url_arr[$i+3]) > 0){
                $id = $url_arr[$i+3];
                if (UserManagement::idExists( $id)){
                    if (isset( $url_arr[$i+4]) && strlen( $url_arr[$i+4]) > 0){
                        if ($url_arr[$i+4] == "posts"){
                            echo json_encode( UserManagement::getPosts( $id));
                        }elseif ($url_arr[$i+4] == "comments"){
                            echo json_encode( UserManagement::getComments( $id));
                        }else{
                            include __DIR__."/ErrorRequest.php";
                        }
                    }else{
                        echo json_encode( UserManagement::getUserFromId( $id));
                    }
                }else{
                    http_response_code( 404);
                    echo json_encode( array( "status" => "ERROR", "error" => "THE USER DOESN'T EXIST", "version" => "v1"));
                }
            }else{
                echo json_encode( UserManagement::getAll());
            }
        }else{
            include __DIR__."/ErrorParams.php";
        }
        break;
    default:
        include __DIR__."/ErrorRequest.php";
        break;
}