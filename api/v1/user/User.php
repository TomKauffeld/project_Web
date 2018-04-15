<?php

require_once __DIR__."/../../sql/SQLConnection.php";
require_once __DIR__."/../../3rdPartie/RSA/RSA.php";

class UserManagement{

    private static function getPrivateKey( ){
        require_once __DIR__."/../../3rdPartie/RSA/private.php";
        return openssl_pkey_get_private( $privateKey, "1234");
    }
    
    public static function getPublicKey( ){
        return openssl_pkey_get_public( "file://../../3rdPartie/RSA/public.pem");
    }

    private static function createToken( string $id){
        $base = array( "a" => $id, "b" => time(), "c" => bin2hex( random_bytes( 64)));
        $hash = RSA::encrypt( json_encode( $base), getPrivateKey());
        return array( "a" => $base["a"], "b" => $base["b"], "c" => $base["c"], "d" => $hash);
    }

    /**
     * Gets an user from the database based on the id
     * @param string $id the id of the user to search
     * @return User|NULL when the user is found, else NULL
     */
    public static function getUserFromId( string $id){
        return UserDataBase::getFromId( $id);
    }

    public static function loginWithPassword( string $username, string $password){     
        $query = "SELECT password, id FROM blog_user WHERE username=:username";
        SQLConnection::executeQuery( $query, array( ":username" => array( $username, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        if (isset( $result[0]["password"])){
            if (password_verify( $password, $result[0]["password"])){
                $token = UserManagement::createToken( $result[0]["id"]);
                $user = UserManagement::getUserFromId( $result[0]["id"]);
                return array( "status" => "OK", "loggedIn" => true, "token" => $token, "user" => $user);
            }else{
                return array( "status" => "OK", "loggedIn" => false);
            }
        }else{
            return array( "status" => "OK", "loggedIn" => false);
        }
    }

    public static function createUser( string $username, string $password){
        if (strlen( $username) < 3){
            return array( "status" => "ERROR", "error" => "THE USERNAME MUST BE AT LEAST 3 CHARACTERS LONG");
        }elseif (strlen( $password) < 6) {
            return array( "status" => "ERROR", "error" => "THE PASSWORD MUST BE AT LEAST 6 CHARACTERS LONG");
        }elseif( UserDataBase::usernameExists( $username)){
            return array( "status" => "ERROR", "error" => "THE USERNAME IS ALREADY TAKEN");
        }elseif (strcmp( $username, $password) == 0){
            return array( "status" => "ERROR", "error" => "THE PASSWORD MUST BE DIFFERENT THAN THE USERNAME");
        }
        $id = "";
        do {
            $id = bin2hex( random_bytes( 64));
        } while (UserDataBase::idExists( $id));
        $query = "INSERT INTO blog_user VALUES( :id, :username, 0, :password, :time)";
        $val = SQLConnection::executeQuery( $query, array(
            ":id" => array( $id, PDO::PARAM_STR),
            ":username" => array( $username, PDO::PARAM_STR),
            ":password" => array( password_hash( $password, 1), PDO::PARAM_STR),
            ":time" => array( time(), PDO::PARAM_INT)
        ));
        if ($val){
            $user = UserManagement::getUserFromId( $id);
            $token = UserManagement::createToken( $id);
            return array( "status" => "OK", "token" => $token, "user" => $user);
        }else{
            return array( "status" => "ERROR", "error" => "SQL ERROR");
        }
    }

}
class UserDataBase{

    /**
     * Gets an user from the database based on the id
     * @param string $id the id of the user to search
     * @return User|NULL when the user is found, else NULL
     */
    public static function getFromId( string $id){
        $query = "SELECT id, username, adminLvL FROM blog_user WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_INT)));
        $result = SQLConnection::getResults();
        if (isset( $result[0]["id"])){
            return new User( $result[0]["id"], $result[0]["username"], $result[0]["adminLvL"]);
        }else{
            return null;
        }
    }

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

}


class User implements JsonSerializable{

    /**
     * @var string $id the id of the user
     * @var string $name the name of the user
     * @var int $adminLvL the level of permission : 0 user, 1 admin, 2 super-admin
     */
    private $id, $name, $adminLvL;

    /**
     * @param string $id the id of the user
     * @param string $name the name of the user
     * @param int $adminLvL the level of permission : 0 user, 1 admin, 2 super-admin
     */
    public function __construct( string $id, string $name, int $adminLvL){
        $this->name = $name;
        $this->adminLvL = $adminLvL;
    }

    /**
     * @return string the id of the user
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string the name of the user
     */
    public function getName( ){
        return $this->name;
    }

    /**
     * @return int the level of permission : 0 user, 1 admin, 2 super-admin
     */
    public function getAdminLvL( ){
        return $thus->adminLvL;
    }

    /**
     * {@inheritdoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "adminLvL" => $this->getAdminLvL()
        ];
    }

}