<?php

require_once __DIR__."/../database/CategoryDatabase.php";
require_once __DIR__."/PostManagement.php";
require_once __DIR__."/../objects/Category.php";

class CategoryManagement{
    
    /**
     * checks if the id exists
     * @param string $id the id to search for
     * @return boolean true if the id exists, false otherwise
     */
    public static function idExists( string $id){
        return CategoryDatabase::idExists( $id);
    }
    
    /**
     * gets all the categories
     * @return array the response
     */
    public static function getAll( ){
        $ids = CategoryDatabase::getAll( );
        return array( "status" => "OK", "lenght" => count( $ids), "categories" => $ids, "version" => "v1");
    }

    /**
     * gets a specific category
     * @param string $id the id to search for
     * @return array the response
     */
    public static function get( string $id){
        $category = CategoryDatabase::get( $id);
        if ($category == null){
            return array( "status" => "ERROR", "error" => "CATEGORY DOESN'T EXIST", "version" => "v1");
        }else{
            return array( "status" => "OK", "category" => $category, "version" => "v1");
        }
    }

    /**
     * gets the posts that have a specific category
     * @param string $id the id of the category to search for
     * @return array the response
     */
    public static function getPosts( string $id){
        return PostManagement::getAllFromCategory( $id);
    }

    /**
     * changes the name of a category
     * @param string $id the id of the category to change
     * @param string $name the new name of the category
     * @return array the response
     */
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

    /**
     * creates a new category
     * @param string $token the token of the user creating this category
     * @param string $name the name of the new category
     * @param string $description the description of the new category
     * @return array the response
     */
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