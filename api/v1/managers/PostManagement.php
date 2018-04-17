<?php

require_once __DIR__."/CommentManagement.php";
require_once __DIR__."/../database/PostDatabase.php";
require_once __DIR__."/../objects/Post.php";
require_once __DIR__."/TokenManagement.php";
require_once __DIR__."/../objects/User.php";

class PostManagement{

    /**
     * searches if the id exists
     * @param string $id the id to search for
     * @return boolean true if the id exists, false if it doesn't exist
     */
    public static function idExists( string $id){
        return PostDatabase::idExists( $id);
    }

    /**
     * gets the ids of all the posts
     * @param int $limit the number of posts to get, -1 for all
     * @param int $offset the number of posts to skip, -1 or 0 for no offset
     * @return array the response
     */
    public static function getAll( int $limit = -1, int $offset = -1){
        $ids = PostDatabase::getAll( $limit, $offset);
        return array( "status" => "OK", "lenght" => count( $ids), "posts" => $ids, "version" => "v1");
    }

    /**
     * gets a post 
     * @param string $id the id to search for
     * @return array the response
     */
    public static function get( string $id){
        $post = PostDatabase::get( $id);
        if ($post == null){
            return array( "status" => "ERROR", "error" => "POST DOESN'T EXIST", "version" => "v1");
        }else{
            return array( "status" => "OK", "post" => $post);
        }
    }

    /**
     * gets the posts made by a specific user
     * @param string $id the id of the user to search for
     * @return array the response
     */
    public static function getAllFromUser( string $id){
        $ids = PostDatabase::getAllFromUser( $id);
        return array( "status" => "OK", "lenght" => count( $ids), "posts" => $ids, "version" => "v1");
    }

    /**
     * gets the posts that have a specific category
     * @param string $id the id of the category to search for
     * @return array the response
     */
    public static function getAllFromCategory( string $id){
        $ids = PostDatabase::getAllFromCategory( $id);
        return array( "status" => "OK", "lenght" => count( $ids), "posts" => $ids, "version" => "v1");
    }

    /**
     * gets the comments made on a post
     * @param string $id the id of the post to search for
     * @return array the response
     */
    public static function getComments( string $id){
        return CommentManagement::getAllFromPost( $id);
    }

    /**
     * creates a new post
     * @param array $token the token of the user that makes the post
     * @param array $categories the ids of the categories this post has (minimum 1)
     * @param string $title the title of the post
     * @param string $body the body of the post
     * @return array the response
     */
    public static function createNew( array $token, array $categories, string $title, string $body){
        $user = TokenManagement::checkTokenJson( $token);
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