<?php

require_once __DIR__."/CommentManagement.php";
require_once __DIR__."/../database/PostDatabase.php";
require_once __DIR__."/../objects/Post.php";

class PostManagement{

    public static function getAll( ){
        $ids = PostDatabase::getAll();
        return array( "status" => "OK", "lenght" => count( $ids), "posts" => $ids, "version" => "v1");
    }

    public static function get( string $id){
        $post = PostDatabase::get( $id);
        if ($post == null){
            return array( "status" => "ERROR", "error" => "POST DOESN'T EXIST", "version" => "v1");
        }else{
            return array( "status" => "OK", "post" => $post);
        }
    }

    public static function getAllFromUser( string $id){
        $ids = PostDatabase::getAllFromUser( $id);
        return array( "status" => "OK", "lenght" => count( $ids), "posts" => $ids, "version" => "v1");
    }

    public static function getComments( string $id){
        return CommentManagement::getAllFromPost( $id);
    }

    public static function createNew( string $token, string $title, string $body){
        
    }

}