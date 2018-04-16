<?php

require_once __DIR__."/../objects/Post.php";
require_once __DIR__."/../../sql/SQLConnection.php";

class PostDatabase{

    public static function get( string $id){
        $query = "SELECT id, author, title, body, time FROM blog_post WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_INT)));
        $result = SQLConnection::getResults();
        if (isset( $result[0]["id"])){
            return new Post( $result[0]["id"], $result[0]["author"], $result[0]["title"], $result[0]["body"], $result[0]["time"]);
        }else{
            return null;
        }
    }

    public static function getAll( ){
        $query = "SELECT id FROM blog_post";
        SQLConnection::executeQuery( $query);
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    public static function getAllFromUser( string $id){
        $query = "SELECT id FROM blog_post WHERE author=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    public static function createNew( string $author, string $title, string $body){

    }

}