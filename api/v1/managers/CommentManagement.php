<?php

require_once __DIR__."/../database/CommentDatabase.php";
require_once __DIR__."/../objects/User.php";
require_once __DIR__."/../objects/Comment.php";
require_once __DIR__."/TokenManagement.php";

class CommentManagement{

    public static function idExists( string $id){
        return CommentDatabase::idExists( $id);
    }
    
    public static function getAll( int $limit = -1, int $offset = -1){
        $ids = CommentDatabase::getAll( $limit, $offset);
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
        $user = TokenManagement::checkTokenString( $token);
        if ($user != null){
            $comment = CommentDatabase::createNew( $token["id"], $post, $body);
            if ($comment == null){
                return array( "status" => "ERROR", "error" => "INVALID POST", "version" => "v1");
            }else{
                return array( "status" => "OK", "id" => $comment->getId(), "version" => "v1");
            }
        }else{
            return array( "status" => "ERROR", "error" => "INVALID TOKEN", "version" => "v1");            
        }
    }
}