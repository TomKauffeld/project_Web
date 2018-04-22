<?php
header('Content-Type: application/json');
header( "Access-Control-Allow-Origin: *");
require_once __DIR__."/../managers/CommentManagement.php";

$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if (($i+3 == $lenght || $i+4 == $lenght) && !(isset( $url_arr[$i+3]) && strlen( $url_arr[$i+3]) > 0)){
            if (isset( $_POST["token"]) && isset( $_POST["post"]) && isset( $_POST["body"])){
                if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                    $response = CommentManagement::createNew( $_POST["token"], $_POST["post"], $_POST["body"]);
                    if ($response["status"] == "ERROR"){
                        if ($response["error"] == "INVALID TOKEN"){
                            http_response_code( 401);
                        }elseif ($response["error"] == "INVALID POST") {
                            http_response_code( 400);
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
        if ($i+3 == $lenght || $i+4 == $lenght || $i+5 == $lenght){
            if (($url_arr[$i+2] == "comments" || $url_arr[$i+2] == "comment") && !(isset( $url_arr[$i+4]) && strlen( $url_arr[$i+4]) > 0)){
                if(isset( $url_arr[$i+3]) && strlen($url_arr[$i+3]) > 0){
                    $id = $url_arr[$i+3];
                    if (CommentManagement::idExists( $id)){
                        echo json_encode( CommentManagement::get( $id));
                    }else{
                        http_response_code( 404);
                        echo json_encode( array( "status" => "ERROR", "error" => "THE COMMENT DOESN'T EXIST", "version" => "v1"));
                    }
                }else{
                    $limit = isset( $_GET["limit"]) ? $_GET["limit"] : -1;
                    $offset = isset( $_GET["offset"]) ? $_GET["offset"] : -1;
                    if ($limit > 0){
                        if ($offset >= 0){
                            echo json_encode( CommentManagement::getAll( $limit, $offset));
                        }else{
                            echo json_encode( CommentManagement::getAll( $limit));
                        }
                    }else{
                        echo json_encode( CommentManagement::getAll( ));
                    }   
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