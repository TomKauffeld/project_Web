<?php

require_once __DIR__."/../database/CategoryDatabase.php";
require_once __DIR__."/PostManagement.php";
require_once __DIR__."/../objects/Category.php";

class CategoryManagement{
    
    public static function idExists( string $id){
        return CategoryDatabase::idExists( $id);
    }
    
    public static function getAll( int $limit = -1, int $offset = -1){
        $ids = CategoryDatabase::getAll( $limit, $offset);
        return array( "status" => "OK", "lenght" => count( $ids), "categories" => $ids, "version" => "v1");
    }

    public static function get( string $id){
        $category = CategoryDatabase::get( $id);
        if ($category == null){
            return array( "status" => "ERROR", "error" => "CATEGORY DOESN'T EXIST", "version" => "v1");
        }else{
            return array( "status" => "OK", "category" => $category, "version" => "v1");
        }
    }

    public static function getPosts( string $id){
        return PostManagement::getAllFromCategory( $id);
    }

    public static function changeName( string $token, string $id, string $name){
        $user = TokenManagement::checkTokenString( $token);
        if ($user != null){
            if ($user->getAdminLvL() >= 2){
                $category = CategoryDatabase::changeName( $id, $name);
                if ($category == null){
                    return array( "status" => "ERROR", "error" => "NAME ALREADY TAKEN", "version" => "v1");
                }else{
                    return array( "status" => "OK", "category" => $category, "version" => "v1");
                }
            }else{
                return array( "status" => "ERROR", "error" => "FORBIDDEN", "version" => "v1");
            }
        }else{
            return array( "status" => "ERROR", "error" => "INVALID TOKEN", "version" => "v1");            
        }
    }

    public static function createNew( string $token, string $name, string $description){
        $user = TokenManagement::checkTokenString( $token);
        if ($user != null){
            if ($user->getAdminLvL() >= 2){
                $category = CategoryDatabase::createNew( $name, $description);
                if ($category == null){
                    return array( "status" => "ERROR", "error" => "NAME ALREADY TAKEN", "version" => "v1");
                }else{
                    return array( "status" => "OK", "id" => $category->getId(), "version" => "v1");
                }
            }else{
                return array( "status" => "ERROR", "error" => "FORBIDDEN", "version" => "v1");
            }
        }else{
            return array( "status" => "ERROR", "error" => "INVALID TOKEN", "version" => "v1");            
        }
    }
}