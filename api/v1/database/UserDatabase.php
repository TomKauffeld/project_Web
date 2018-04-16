<?php

require_once __DIR__."/../../sql/SQLConnection.php";
require_once __DIR__."/../objects/User.php";

class UserDataBase{

    private static function generateId( ){
        $id = "";
        do {
            $id = bin2hex( random_bytes( 64));
        } while (UserDataBase::idExists( $id));
        return $id;
    }

    public static function createNew( string $username, string $password){
        $id = UserDataBase::generateId();
        $query = "INSERT INTO blog_user VALUES( :id, :username, 0, :password, :time)";
        $val = SQLConnection::executeQuery( $query, array(
            ":id" => array( $id, PDO::PARAM_STR),
            ":username" => array( $username, PDO::PARAM_STR),
            ":password" => array( password_hash( $password, 1), PDO::PARAM_STR),
            ":time" => array( time(), PDO::PARAM_INT)
        ));
        if ($val){
            return UserDataBase::get( $id);
        }else{
            return null;
        }
    }

    public static function loginWithPassword( string $username, string $password){     
        $query = "SELECT password, id FROM blog_user WHERE username=:username";
        SQLConnection::executeQuery( $query, array( ":username" => array( $username, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        if (isset( $result[0]["password"])){
            if (password_verify( $password, $result[0]["password"])){
                return UserDataBase::get( $result[0]["id"]);
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    /**
     * Gets an user from the database based on the id
     * @param string $id the id of the user to search
     * @return User|NULL when the user is found, else NULL
     */
    public static function get( string $id){
        $query = "SELECT id, username, adminLvL FROM blog_user WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_INT)));
        $result = SQLConnection::getResults();
        if (isset( $result[0]["id"])){
            return new User( $result[0]["id"], $result[0]["username"], $result[0]["adminLvL"]);
        }else{
            return null;
        }
    }

    /**
     * @param string $id the id to search for
     * @return boolean true if the id exists, false if it doesn't exist
     */
    public static function idExists( string $id){
        $query = "SELECT count(*) FROM blog_user WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_INT)));
        $result = SQLConnection::getResults();
        if ($result[0][0] > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param string $username the username to search for
     * @return boolean true if the username exists, false if it doesn't exist
     */
    public static function usernameExists( string $username){
        $query = "SELECT count(*) FROM blog_user WHERE username=:username";
        SQLConnection::executeQuery( $query, array( ":username" => array( $username, PDO::PARAM_INT)));
        $result = SQLConnection::getResults();
        if ($result[0][0] > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @return array list of all the users
     */
    public static function getAll( ){
        $query = "SELECT id FROM blog_user";
        SQLConnection::executeQuery( $query);
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

}