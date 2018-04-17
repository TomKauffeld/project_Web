<?php
header('Content-Type: application/json');
require_once __DIR__."/../managers/CategoryManagement.php";

$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        $request = json_decode( file_get_contents( 'php://input'), true);
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if (($i+3 == $lenght || $i+4 == $lenght) && !(isset( $url_arr[$i+3]) && strlen( $url_arr[$i+3]) > 0)){
            if (isset( $request["token"]) && isset( $request["name"]) && isset( $request["description"])){
                if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                    $response = CategoryManagement::createNew( $request["token"], $request["name"], $request["description"]);
                    if ($response["status"] == "ERROR"){
                        if ($response["error"] == "INVALID TOKEN"){
                            http_response_code( 401);
                        }elseif( $response["error"] == "FORBIDDEN"){
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
    case "PATCH":
        $request = json_decode( file_get_contents( 'php://input'), true);
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if (($i+4 == $lenght || $i+5 == $lenght) && !(isset( $url_arr[$i+4]) && strlen( $url_arr[$i+4]) > 0)){
            if (isset( $request["token"]) && isset( $request["name"])){
                if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                    $response = CategoryManagement::changeName( $request["token"], $url_arr[$i+3], $request["name"]);
                    if ($response["status"] == "ERROR"){
                        if ($response["error"] == "INVALID TOKEN"){
                            http_response_code( 401);
                        }elseif( $response["error"] == "FORBIDDEN"){
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
        $all = explode( "?", $_SERVER["REQUEST_URI"]);
        $url_arr = explode( "/", $all[0]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if ($i+3 == $lenght || $i+4 == $lenght || $i+5 == $lenght || $i+6 == $lenght){
            if (($url_arr[$i+2] == "category" || $url_arr[$i+2] == "categories") && !(isset( $url_arr[$i+5]) && strlen( $url_arr[$i+5]) > 0)){
                if (isset( $url_arr[$i+3]) && strlen($url_arr[$i+3]) > 0){
                    $id = $url_arr[$i+3];
                    if (CategoryManagement::idExists( $id)){
                        if (isset( $url_arr[$i+4]) && strlen( $url_arr[$i+4]) > 0){
                            if ($url_arr[$i+4] == "posts"){
                                echo json_encode( CategoryManagement::getPosts( $id));
                            }else{
                                include __DIR__."/ErrorRequest.php";
                            }
                        }else{
                            echo json_encode( CategoryManagement::get( $id));
                        }
                    }else{
                        http_response_code( 404);
                        echo json_encode( array( "status" => "ERROR", "error" => "THE CATEGORY DOESN'T EXIST", "version" => "v1"));
                    }
                }else{
                    echo json_encode( CategoryManagement::getAll( ));
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