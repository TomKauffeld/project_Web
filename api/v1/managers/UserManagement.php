<?php
require_once __DIR__."/../database/UserDatabase.php";
require_once __DIR__."/../objects/User.php";
require_once __DIR__."/PostManagement.php";
require_once __DIR__."/CommentManagement.php";
require_once __DIR__."/TokenManagement.php";

class UserManagement{

    /**
     * gets all the posts made by a specific user
     * @param string $id the id of the user
     * @return array the reponse
     */
    public static function getPosts( string $id){
        return PostManagement::getAllFromUser( $id);
    }

    /**
     * gets all users
     * @param int $limit the number of users to get, -1 for all
     * @param int $offset the number of users to skip, -1 or 0 for no offset
     * @return array the response
     */
    public static function getAll( int $limit = -1, int $offset = -1){
        $ids = UserDataBase::getAll( $limit, $offset);
        return array( "status" => "OK", "lenght" => count( $ids), "users" => $ids, "version" => "v1");
    }

    /**
     * gets all the comments made by a specific user
     * @param string $id the id of the user
     * @return array the response
     */
    public static function getComments( string $id){
        return CommentManagement::getAllFromUser( $id);
    }

    /**
     * gets an user 
     * @param string $id the id of the user to search
     * @return array the response
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
     * logges a user in, creates a token
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
     * changes the admin lvl of an user
     * @param string $token the token of the user making the change
     * @param string $id the id of the user to make the change to
     * @param string $adminLvL the new admin lvl of the user
     * @return array the response
     */
    public static function changeAdminLvL( string $token, string $id, int $adminLvL){
        $user = TokenManagement::checkTokenString( $token);
        if ($user != null){
            if ($user["adminLvL"] >= 2){
                if (UserDataBase::changeAdminLvL( $id, $adminLvL)){
                    return array( "status" => "OK", "version" => "v1");
                }else{
                    return array( "status" => "ERROR", "error" => "PARAMS NOT VALID", "version" => "v1");
                }
            }else{
                return array( "status" => "ERROR", "error" => "FORBIDDEN", "version" => "v1");
            }
        }else{
            return array( "status" => "ERROR", "error" => "INVALID TOKEN", "version" => "v1");
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