<?php
require_once __DIR__."/../objects/Category.php";
require_once __DIR__."/../../sql/SQLConnection.php";
require_once __DIR__."/IdGenerator.php";

class CategoryDatabase{

    /**
     * returns the number of entries inside the database
     * @return int the number of entries
     */
    public static function getNb( ){
        $query = "SELECT COUNT(*) FROM blog_category";
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
        $i = ceil( CategoryDatabase::getNb() / IdGenerator::perChar()) + 1;
        do {
            $id = IdGenerator::create(3, 3 + $i);
            $i++;
        } while (CategoryDatabase::idExists( $id));
        return $id;
    }

    /**
     * gets a specific category
     * @param string $id the id to search for
     * @return Category|NULL the category if it exists, null otherwise
     */
    public static function get( string $id){
        $query = "SELECT id, name, description FROM blog_category WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        if (isset( $result[0]["id"])){
            return new Category( $result[0]["id"], $result[0]["name"], $result[0]["description"]);
        }else{
            return null;
        }
    }

    /**
     * gets all the categories from the database
     * @return array the ids of all the categories
     */
    public static function getAll( ){
        $query = "SELECT id FROM blog_category";
        SQLConnection::executeQuery( $query);
        $result = SQLConnection::getResults();
        $ids = array();
        foreach ($result as $line) {
            $ids[] = $line["id"];
        }
        return $ids;
    }

    /**
     * creates a new category
     * @param string $name the name of the new category
     * @param string $description the description of the new category
     * @return Category|NULL the category created if successfull, null otherwise
     */
    public static function createNew( string $name, string $description){
        if (CategoryDatabase::nameExists( $name)){
            return null;
        }else{
            $id = CategoryDatabase::generateId();
            $query = "INSERT INTO blog_category ( id, name, description) VALUES( :id, :name, :description)";
            SQLConnection::executeQuery( $query, array(
                ":id" => array( $id, PDO::PARAM_STR),
                ":name" => array( $name, PDO::PARAM_STR),
                ":description" => array( $description, PDO::PARAM_STR)
            ));
            return CategoryDatabase::get( $id);
        }
    }

    /**
     * searches if the name exists inside the database
     * @param string $name the name to search for
     * @return boolean if the name exists, false otherwise
     */
    public static function nameExists( string $name){
        $query = "SELECT count(*) FROM blog_category WHERE name=:name";
        SQLConnection::executeQuery( $query, array( ":name" => array( $name, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        if ($result[0][0] > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * searches if the id exists inside the database
     * @param string $id the id to search for
     * @return boolean true if the id exists, false if it doesn't exist
     */
    public static function idExists( string $id){
        $query = "SELECT count(*) FROM blog_category WHERE id=:id";
        SQLConnection::executeQuery( $query, array( ":id" => array( $id, PDO::PARAM_STR)));
        $result = SQLConnection::getResults();
        if ($result[0][0] > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * changes the name of a category
     * @param string $id the id of the category to change
     * @param string $name the new name of the category
     * @return Category|NULL the category if the change was successfull, null otherwise
     */
    public static function changeName( string $id, string $name){
        if (CategoryDatabase::nameExists( $name)){
            return null;
        }else{
            $query = "UPDATE TABLE blog_category SET name=:name WHERE id=:id";
            SQLConnection::executeQuery( $query, array( 
                ":name" => array( $name, PDO::PARAM_STR),
                ":id" => array( $id, PDO::PARAM_STR)
            ));
            return CategoryDatabase::get( $id);
        }
    }


}