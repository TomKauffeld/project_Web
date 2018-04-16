<?php
require_once __DIR__."/../objects/Post.php";
$method = $_SERVER['REQUEST_METHOD'];
switch ($method){
    case "POST":

    case "GET":

        break;
    default:
        include __DIR__."/ErrorRequest.php";
        break;
}