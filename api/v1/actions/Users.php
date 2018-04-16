<?php
header('Content-Type: application/json');
require_once __DIR__."/../managers/UserManagement.php";
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        $url_arr = explode( "/", $_SERVER["REQUEST_URI"]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if (($i+3 == $lenght || $i+4 == $lenght) && !(isset( $url_arr[$i+3]) && strlen( $url_arr[$i+3]) > 0)){
            if (isset( $_POST["username"]) && isset( $_POST["password"])){
                if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                    echo json_encode( UserManagement::createNew( $_POST["username"], $_POST["password"]));
                }else{
                    http_response_code( 505);
                    echo json_encode( array( "status" => "ERROR", "error" => "NOT A SECURE CONNECTION", "version" => "v1"));
                }
            }else{
                http_response_code( 400);
                echo json_encode( array( "status" => "ERROR", "error" => "USERNAME OR PASSWORD NOT SET", "version" => "v1"));
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
        if ($i+3 == $lenght || $i+4 == $lenght || $i+6 == $lenght || $i+5 == $lenght){
            if (($url_arr[$i+2] == "user" || $url_arr[$i+2] == "users") && !(isset( $url_arr[$i+5]) && strlen( $url_arr[$i+5]) > 0)){
                if (isset( $url_arr[$i+3]) && strlen($url_arr[$i+3]) > 0){
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
                            echo json_encode( UserManagement::get( $id));
                        }
                    }else{
                        http_response_code( 404);
                        echo json_encode( array( "status" => "ERROR", "error" => "THE USER DOESN'T EXIST", "version" => "v1"));
                    }
                }else{
                    $limit = isset( $_GET["limit"]) ? $_GET["limit"] : -1;
                    $offset = isset( $_GET["offset"]) ? $_GET["offset"] : -1;
                    if ($limit > 0){
                        if ($offset >= 0){
                            echo json_encode( UserManagement::getAll( $limit, $offset));
                        }else{
                            echo json_encode( UserManagement::getAll( $limit));
                        }
                    }else{
                        echo json_encode( UserManagement::getAll( ));
                    }   
                }
            }else{
                include __DIR__."/ErrorRequest.php";
            }
        }else{
            include __DIR__."/ErrorParams.php";
        }
        break;
    case "PATCH":
        $all = explode( "?", $_SERVER["REQUEST_URI"]);
        $url_arr = explode( "/", $all[0]);
        $lenght = count( $url_arr);
        $i = array_search( "api", $url_arr);
        if ($i+4 == $lenght || $i+5 == $lenght){
            if (($url_arr[$i+2] == "user" || $url_arr[$i+2] == "users") && !(isset( $url_arr[$i+4]) && strlen( $url_arr[$i+4]) > 0)){
                if (isset( $url_arr[$i+3]) && strlen($url_arr[$i+3]) > 0){
                    $id = $url_arr[$i+3];
                    if (UserManagement::idExists( $id)){
                        if (isset( $_POST["token"]) && isset( $_POST["adminLvL"])){
                            $ret = UserManagement::changeAdminLvL( $_POST["token"], $id, $_POST["adminLvL"]);
                            if ($ret["status"] != "OK"){
                                if ($ret["error"] == "INVALID TOKEN"){
                                    http_response_code( 401);
                                }elseif( $ret["error"] == "FORBIDDEN"){
                                    http_response_code( 403);
                                }else{
                                    http_response_code( 500);
                                }
                            }
                            echo json_encode( $ret);
                        }else{
                            include __DIR__."/ErrorParams.php";
                        }
                    }else{
                        http_response_code( 404);
                        echo json_encode( array( "status" => "ERROR", "error" => "THE USER DOESN'T EXIST", "version" => "v1"));
                    }
                }else{
                    include __DIR__."/ErrorParams.php";
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