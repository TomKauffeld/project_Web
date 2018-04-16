<?php
require_once __DIR__."/../managers/PostManagement.php";

$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if (($i+3 == $lenght || $i+4 == $lenght) && !(isset( $url_arr[$i+3]) && strlen( $url_arr[$i+3]) > 0)){
            if (isset( $_POST["token"]) && isset( $_POST["title"]) && isset( $_POST["body"])){
                if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                    $response = PostManagement::createNew( $_POST["token"], $_POST["title"], $_POST["body"]);
                    if ($response["status"] == "ERROR"){
                        if ($response["error"] == "INVALID TOKEN"){
                            http_response_code( 401);
                        }elseif( $response["error"] == "NOT PERMITTED"){
                            http_response_code( 403);
                        }
                    }
                    echo json_encode( $response);
                }else{
                    http_response_code( 505);
                    echo json_encode( array( "status" => "ERROR", "error" => "NOT A SECURE CONNECTION", "version" => "v1"));
                }
            }else{
                http_response_code( 400);
                echo json_encode( array( "status" => "ERROR", "error" => "PARAMS NOT SET", "version" => "v1"));
            }
        }else{
            include __DIR__."/ErrorRequest.php";
        }
        break;
    case "GET":
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if ($i+3 == $lenght || $i+4 == $lenght || $i+5 == $lenght || $i+6 == $lenght){
            if (($url_arr[$i+2] == "post" || $url_arr[$i+2] == "posts") && !(isset( $url_arr[$i+5]) && strlen( $url_arr[$i+5]) > 0)){
                if (isset( $url_arr[$i+3]) && strlen($url_arr[$i+3]) > 0){
                    $id = $url_arr[$i+3];
                    if (PostManagement::idExists( $id)){
                        if (isset( $url_arr[$i+4]) && strlen( $url_arr[$i+4]) > 0){
                            if ($url_arr[$i+4] == "comments"){
                                echo json_encode( PostManagement::getComments( $id));
                            }else{
                                include __DIR__."/ErrorRequest.php";
                            }
                        }else{
                            echo json_encode( PostManagement::get( $id));
                        }
                    }else{
                        http_response_code( 404);
                        echo json_encode( array( "status" => "ERROR", "error" => "THE POST DOESN'T EXIST", "version" => "v1"));
                    }
                }else{
                    echo json_encode( PostManagement::getAll());
                }
            }else{
                include __DIR__."/ErrorRequest.php";
            }
        }else{
            include __DIR__."/ErrorParams.php";
        }
        break;
    default:
        include __DIR__."/ErrorRequest.php";
        break;
}