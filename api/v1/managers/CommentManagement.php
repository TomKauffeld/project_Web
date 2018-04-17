<?php

require_once __DIR__."/../database/CommentDatabase.php";
require_once __DIR__."/../objects/User.php";
require_once __DIR__."/../objects/Comment.php";
require_once __DIR__."/TokenManagement.php";

class CommentManagement{

    /**
     * searches if the id exists
     * @param string $id the id to search for
     * @return boolean true if the id exists, false if it doesn't exist
     */
    public static function idExists( string $id){
        return CommentDatabase::idExists( $id);
    }
    
    /**
     * gets the ids of all the comments
     * @param int $limit the number of comments to get, -1 for all
     * @param int $offset the number of comments to skip, -1 or 0 for no offset
     * @return array the response
     */
    public static function getAll( int $limit = -1, int $offset = -1){
        $ids = CommentDatabase::getAll( $limit, $offset);
        return array( "status" => "OK", "lenght" => count( $ids), "comments" => $ids, "version" => "v1");
    }

    /**
     * gets a comment 
     * @param string $id the id to search for
     * @return array the response
     */
    public static function get( string $id){
        $comment = CommentDatabase::get( $id);
        if ($comment == null){
            return array( "status" => "ERROR", "error" => "COMMENT DOESN'T EXIST", "version" => "v1");
        }else{
            return array( "status" => "OK", "comment" => $comment, "version" => "v1");
        }
    }

    /**
     * gets the comments made by a specific user
     * @param string $id the id of the user to search for
     * @return array the response
     */
    public static function getAllFromUser( string $id){
        $ids = CommentDatabase::getAllFromUser( $id);
        return array( "status" => "OK", "lenght" => count($ids), "comments" => $ids, "version" => "v1");
    }

    /**
     * gets the comments from a specific post
     * @param string $id the id of the post to search for
     * @return array the response
     */
    public static function getAllFromPost( string $id){
        $ids = CommentDatabase::getAllFromPost( $id);
        return array( "status" => "OK", "lenght" => count($ids), "comments" => $ids, "version" => "v1");
    }

    /**
     * creates a new comment
     * @param string $token the token of the user that makes the comment
     * @param string $post the id of the post the comment is made on
     * @param string $body the body of the comment
     * @return array the response
     */
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