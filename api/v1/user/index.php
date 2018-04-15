<?php
require_once __DIR__."/User.php";

$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":
        if (isset( $_POST["username"]) && isset( $_POST["password"])){
            if (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443)){
                echo json_encode( UserManagement::createUser( $_POST["username"], $_POST["password"]));
            }else{
                echo json_encode( array( "status" => "ERROR", "error" => "NOT A SECURE CONNECTION"));
            }
        }else{
            echo json_encode( array( "status" => "ERROR", "error" => "USERNAME OR PASSWORD NOT SET"));
        }
        break;
    case "GET":
        if (isset( $_GET["id"])){
            $user = UserManagement::getUserFromId( $_GET["id"]);
            if ($user != null){
                echo json_encode( array( "status" => "OK", "user" => $user));
            }else{
                echo json_encode( array( "status" => "ERROR", "error" => "THE USER DOESN'T EXIST"));
            }
        }else{
            echo json_encode( array( "status" => "ERROR", "error" => "ID NOT SET"));
        }
        break;
    default:
        echo json_encode( array( "status" => "ERROR", "error" => "BAD REQUEST"));
        break;
}