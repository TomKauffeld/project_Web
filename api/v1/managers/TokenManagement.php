<?php

require_once __DIR__."/../../3rdParty/RSA/RSA.php";
require_once __DIR__."/UserManagement.php";
require_once __DIR__."/../objects/User.php";

class TokenManagement{

    /**
     * @var int $MAX_TIME the amount of seconds the token is valid (30 days)
     */
    private static $MAX_TIME = 3600*24*30;

    /**
     * validates a token
     * @param array $token the token
     * @return User|NULL retures the user if the token is valid, null otherwise
     */
    public static function checkTokenJson( array $token){
        if (isset( $token["id"]) && isset( $token["b"]) && isset( $token["c"]) && isset( $token["d"])){
            $decrypt = RSA::decrypt( $token["d"], RSA::getPublicKey());
            $json = json_decode( $decrypt, true);
            if (isset( $json["id"]) && isset( $json["b"]) && isset( $json["c"]) && $json["id"] == $token["id"] && $json["b"] == $token["b"] && $json["c"] == $token["c"]){
                if ($token["b"] + TokenManagement::$MAX_TIME > time()){
                    return UserManagement::get( $json["id"]);
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    /**
     * validates a token
     * @param string $token the token
     * @return User|NULL retures the user if the token is valid, null otherwise
     */
    public static function checkTokenString( string $token){
        return TokenManagement::checkTokenJson( json_decode( $token, true));
    }

    /**
     * creates a new token
     * @param string $id the id of the user
     * @return array the token
     */
    public static function createToken( string $id){
        $base = array( "id" => $id, "b" => time(), "c" => bin2hex( random_bytes( 64)));
        $hash = RSA::encrypt( json_encode( $base));
        return array( "id" => $base["id"], "b" => $base["b"], "c" => $base["c"], "d" => $hash);
    }

}