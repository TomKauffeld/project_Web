<?php

require_once __DIR__."/../objects/Comment.php";
require_once __DIR__."/../../sql/SQLConnection.php";
require_once __DIR__."/PostDatabase.php";
require_once __DIR__."/UserDatabase.php";
require_once __DIR__."/IdGenerator.php";

class CommentDatabase{

    /**
     * returns the number of entries inside the database
     * @return int the number of entries
     */
    public static function getNb( ){
        $query = "SELECT COUNT(*) FROM blog_comment";
        SQLConnection::executeQuery( $query);
        $result = SQLConnection::getResults();
        return $result[0][0];
    }

    /**
     * generates an id that's not yet used in the database
     * @return string a new id
     */
    private static function generateId( ){
        $id = "";
        $i = ceil( CommentDatabase::getNb() / IdGenerator::perChar()) + 1;
        do {
            $id = IdGenerator::create(3, 3+$i);
            $i++;
        } while (CommentDatabase::idExists( $id));
        return $id;
    }

    /**
     * searches if the id exists inside the database
     * @param string $id the id to search for
     * @return boolean true if the id exists, false if it doesn't exist
     */
    public static function idExists( string $id){
        $query = "SELECT count(*) FROM blog_comment WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_INT)));
        $result = SQLConnection::getResults();
        if ($result[0][0] > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * returns the ids of all the comments inside of the database
     * @return array list of all the comments
     */
    public static function getAll( int $limit = -1, int $offset = -1){
        if ($limit > 0){
            if ($offset >= 0){
                $query = "SELECT id FROM blog_comment ORDER BY -time LIMIT :limit OFFSET :offset";
                SQLConnection::executeQuery( $query, array(
                    ":limit" => array( $limit, PDO::PARAM_INT),
                    ":offset" => array( $offset, PDO::PARAM_INT)
                ));
            }else{
                $query = "SELECT id FROM blog_comment ORDER BY -time LIMIT :limit";
                SQLConnection::executeQuery( $query, array( ":limit" => array( $limit, PDO::PARAM_INT)));
            }
        }else{
            $query = "SELECT id FROM blog_comment ORDER BY -time";
            SQLConnection::executeQuery( $query);
        }

        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    /**
     * returns the ids of all the comments made by a user
     * @param string $id the id of the user to search for
     * @return array list of all the comments made by a user
     */
    public static function getAllFromUser( string $id){
        $query = "SELECT id FROM blog_comment WHERE author=:id ORDER BY -time";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    /**
     * returns the ids of all the comments on a post
     * @param string $id the id of the post to search for
     * @return array list of all the comments on a post
     */
    public static function getAllFromPost( string $id){
        $query = "SELECT id FROM blog_comment WHERE post=:id ORDER BY -time";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    /**
     * gets a comment from the database
     * @param string $id the id of the comment
     * @return Comment|NULL returns the comment if is exists, null otherwise
     */
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

    /**
     * creates a new comment inside the database
     * @param string $author the id of the user that made the comment
     * @param string $post the id of the post the comment was made on
     * @param string $body the body of the comment
     * @return Comment|NULL returns the comment if successfull, null otherwise
     */
    public static function createNew( string $author, string $post, string $body){
        if (UserDataBase::idExists( $author) && PostDatabase::idExists( $post)){
            $id = CommentDatabase::generateId();
            $query = "INSERT INTO blog_comment ( id, post, author, body, time) VALUES( :id, :post, :author, :body, :time)";
            $val = SQLConnection::executeQuery( $query, array(
                ":id" => array( $id, PDO::PARAM_STR),
                ":post" => array( $post, PDO::PARAM_STR),
                ":author" => array( $author, PDO::PARAM_STR),
                ":body" => array( $body, PDO::PARAM_STR),
                ":time" => array( time(), PDO::PARAM_INT)
            ));
            if ($val){
                return CommentDatabase::get( $id);
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

}