<?php
require_once __DIR__."/../database/UserDatabase.php";
require_once __DIR__."/../objects/User.php";
require_once __DIR__."/PostManagement.php";
require_once __DIR__."/CommentManagement.php";
require_once __DIR__."/TokenManagement.php";

class UserManagement{

    /**
     * @param string $id the id of the user
     * @return array list of the ids of the posts made by this user
     */
    public static function getPosts( string $id){
        return PostManagement::getAllFromUser( $id);
    }

    /**
     * @return array list of the ids of the users
     */
    public static function getAll( ){
        $ids = UserDataBase::getAll();
        return array( "status" => "OK", "lenght" => count( $ids), "users" => $ids, "version" => "v1");
    }

    /**
     * @param string $id the id of the user
     * @return array list of the ids of the comments made by this user
     */
    public static function getComments( string $id){
        return CommentManagement::getAllFromUser( $id);
    }

    /**
     * Gets an user from the database based on the id
     * @param string $id the id of the user to search
     * @return User|NULL when the user is found, else NULL
     */
    public static function get( string $id){
        $user = UserDataBase::get( $id);
        if ($user != null){
            return array( "status" => "OK", "user" => $user, "version" => "v1");
        }else{
            return array( "status" => "ERROR", "error" => "THE USER DOESN'T EXIST", "version" => "v1");
        }
    }

    /**
     * 
     * @param string $username the username
     * @param string $password the password
     * @return array the response
     */
    public static function loginWithPassword( string $username, string $password){     
        $user = UserDataBase::loginWithPassword( $username, $password);
        if ($user != null){
            $token = TokenManagement::createToken( $user->getId());
            return array( "status" => "OK", "loggedIn" => true, "token" => $token, "user" => $user, "version" => "v1");
        }else{
            return array( "status" => "OK", "loggedIn" => false, "version" => "v1");
        }
    }

    /**
     * creates a new user
     * @param string $username the username
     * @param string $password the password
     * @return array the response
     */
    public static function createNew( string $username, string $password){
        if (strlen( $username) < 3){
            return array( "status" => "ERROR", "error" => "THE USERNAME MUST BE AT LEAST 3 CHARACTERS LONG", "version" => "v1");
        }elseif (strlen( $password) < 6) {
            return array( "status" => "ERROR", "error" => "THE PASSWORD MUST BE AT LEAST 6 CHARACTERS LONG", "version" => "v1");
        }elseif( UserDataBase::usernameExists( $username)){
            return array( "status" => "ERROR", "error" => "THE USERNAME IS ALREADY TAKEN", "version" => "v1");
        }elseif (strcmp( $username, $password) == 0){
            return array( "status" => "ERROR", "error" => "THE PASSWORD MUST BE DIFFERENT THAN THE USERNAME", "version" => "v1");
        }
        $user = UserDataBase::createNew( $username, $password);
        if ($user != null){
            $token = TokenManagement::createToken( $user->getId());
            return array( "status" => "OK", "token" => $token, "user" => $user, "version" => "v1");
        }else{
            http_response_code( 500);
            return array( "status" => "ERROR", "error" => "SQL ERROR", "version" => "v1");
        }
    }

    /**
     * checks if the id is already in use
     * @param string $id the id to search for
     * @return boolean true if the id exists, false otherwise
     */
    public static function idExists( string $id){
        return UserDataBase::idExists( $id);
    }

}