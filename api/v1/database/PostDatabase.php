<?php

require_once __DIR__."/../objects/Post.php";
require_once __DIR__."/../../sql/SQLConnection.php";

class PostDatabase{

    /**
     * generates an id that's not yet used in the database
     * @return string a new id
     */
    private static function generateId( ){
        $id = "";
        do {
            $id = bin2hex( random_bytes( 64));
        } while (PostDatabase::idExists( $id));
        return $id;
    }

    /**
     * searches if the id exists inside the database
     * @param string $id the id to search for
     * @return boolean true if the id exists, false if it doesn't exist
     */
    public static function idExists( string $id){
        $query = "SELECT count(*) FROM blog_post WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_INT)));
        $result = SQLConnection::getResults();
        if ($result[0][0] > 0){
            return true;
        }else{
            return false;
        }
    }

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

    /**
     * creates a new post inside the database
     * @param string $author the id of the user that made the post
     * @param string $title the title of the post
     * @param string $body the body of the post
     * @return Post|NULL returns the post if successfull, null otherwise
     */
    public static function createNew( string $author, string $title, string $body){
        if (UserDataBase::idExists( $author)){
            $id = PostDatabase::generateId();
            $query = "INSERT INTO blog_post VALUES( :id, :author, :title, :body, :time)";
            $val = SQLConnection::executeQuery( $query, array(
                ":id" => array( $id, PDO::PARAM_STR),
                ":author" => array( $author, PDO::PARAM_STR),
                ":title" => array( $title, PDO::PARAM_STR),
                ":body" => array( $body, PDO::PARAM_STR),
                ":time" => array( time(), PDO::PARAM_INT)
            ));
            if ($val){
                return PostDatabase::get( $id);
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
}