<?php

require_once __DIR__."/../objects/Post.php";
require_once __DIR__."/../../sql/SQLConnection.php";
require_once __DIR__."/CategoryDatabase.php";
require_once __DIR__."/UserDatabase.php";

class PostDatabase{

    /**
     * generates an id that's not yet used in the database
     * @return string a new id
     */
    private static function generateId( ){
        $id = "";
        do {
            $id = bin2hex( random_bytes( 50));
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
        $query = "SELECT id, author, category, title, body, time FROM blog_post WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_INT)));
        $result = SQLConnection::getResults();
        if (isset( $result[0]["id"])){
            return new Post( $result[0]["id"], $result[0]["author"], $result[0]["category"], $result[0]["title"], $result[0]["body"], $result[0]["time"]);
        }else{
            return null;
        }
    }

    public static function getAll( int $limit = -1, int $offset = -1){
        if ($limit > 0){
            if ($offset >= 0){
                $query = "SELECT id FROM blog_post ORDER BY -time LIMIT :limit OFFSET :offset";
                SQLConnection::executeQuery( $query, array(
                    ":limit" => array( $limit, PDO::PARAM_INT),
                    ":offset" => array( $offset, PDO::PARAM_INT)
                ));
            }else{
                $query = "SELECT id FROM blog_post ORDER BY -time LIMIT :limit";
                SQLConnection::executeQuery( $query, array( ":limit" => array( $limit, PDO::PARAM_INT)));
            }
        }else{
            $query = "SELECT id FROM blog_post ORDER BY -time";
            SQLConnection::executeQuery( $query);
        }

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

    public static function getAllFromCategory( string $id){
        $query = "SELECT id FROM blog_post WHERE category=:id";
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
    public static function createNew( string $author, string $category, string $title, string $body){
        if (UserDataBase::idExists( $author) && CategoryDatabase::idExists( $category)){
            $id = PostDatabase::generateId();
            $query = "INSERT INTO blog_post ( id, author, category, title, body, time) VALUES( :id, :author, :category, :title, :body, :time)";
            $val = SQLConnection::executeQuery( $query, array(
                ":id" => array( $id, PDO::PARAM_STR),
                ":author" => array( $author, PDO::PARAM_STR),
                ":category" => array( $category, PDO::PARAM_STR),
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