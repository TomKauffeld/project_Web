<?php

require_once __DIR__."/CommentManagement.php";
require_once __DIR__."/../database/PostDatabase.php";
require_once __DIR__."/../objects/Post.php";
require_once __DIR__."/TokenManagement.php";
require_once __DIR__."/../objects/User.php";

class PostManagement{

    public static function idExists( string $id){
        return PostDatabase::idExists( $id);
    }

    public static function getAll( int $limit = -1, int $offset = -1){
        $ids = PostDatabase::getAll( $limit, $offset);
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

    public static function getAllFromCategory( string $id){
        $ids = PostDatabase::getAllFromCategory( $id);
        return array( "status" => "OK", "lenght" => count( $ids), "posts" => $ids, "version" => "v1");
    }

    public static function getComments( string $id){
        return CommentManagement::getAllFromPost( $id);
    }

    public static function createNew( string $token, array $categories, string $title, string $body){
        $user = TokenManagement::checkTokenString( $token);
        if ($user != null){
            if ($user["adminLvL"] >= 1){
                $post = PostDatabase::createNew( $user["id"], $categories, $title, $body);
                if ($post == null){
                    return array( "status" => "ERROR", "error" => "CATEGORIES NOT CORRECT", "version" => "v1");
                }else{
                    return array( "status" => "OK", "id" => $post->getId(), "version" => "v1");
                }

            }else{
                return array( "status" => "ERROR", "error" => "NOT PERMITTED", "version" => "v1");
            }
        }else{
            return array( "status" => "ERROR", "error" => "INVALID TOKEN", "version" => "v1");            
        }
    }
}