<?php

require_once __DIR__."/../objects/Comment.php";
require_once __DIR__."/../../sql/SQLConnection.php";

class CommentDatabase{

    public static function getAll( ){
        $query = "SELECT id FROM blog_comment";
        SQLConnection::executeQuery( $query);
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    public static function getAllFromUser( string $id){
        $query = "SELECT id FROM blog_comment WHERE author=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    public static function getAllFromPost( string $id){
        $query = "SELECT id FROM blog_comment WHERE post=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    public static function get( string $id){
        $query = "SELECT id, post, author, body, time FROM blog_comment WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        if (isset( $result[0]["id"])){
            return new Comment( $result[0]["id"], $result[0]["post"], $result[0]["author"], $result[0]["body"], $result[0]["time"]);
        }else{
            return null;
        }
    }

    public static function createNew( string $author, string $post, string $body){

    }

}