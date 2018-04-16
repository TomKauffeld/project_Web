<?php

require_once __DIR__."/../database/CommentDatabase.php";

class CommentManagement{

    public static function getAll( ){
        $ids = CommentDatabase::getAll();
        return array( "status" => "OK", "lenght" => count( $ids), "comments" => $ids, "version" => "v1");
    }

    public static function get( string $id){
        $comment = CommentDatabase::get( $id);
        if ($comment == null){
            return array( "status" => "ERROR", "error" => "COMMENT DOESN'T EXIST", "version" => "v1");
        }else{
            return array( "status" => "OK", "comment" => $comment, "version" => "v1");
        }
    }

    public static function getAllFromUser( string $id){
        $ids = CommentDatabase::getAllFromUser( $id);
        return array( "status" => "OK", "lenght" => count($ids), "comments" => $ids, "version" => "v1");
    }

    public static function getAllFromPost( string $id){
        $ids = CommentDatabase::getAllFromPost( $id);
        return array( "status" => "OK", "lenght" => count($ids), "comments" => $ids, "version" => "v1");
    }

    public static function createNew( string $token, string $post, string $body){
        
    }
}