<?php

class SQLConnection extends PDO{
    
    /**
     * @var PDOStatement $stmt
     * @var string $username the username to connect to the database
     * @var string $passwd the password to connect to the database
     * @var string $databaseUrl the url of the database
     * @var string $databaseName the name od the database
     */
    private $stmt = null,
            $username = "",
            $passwd = "",
            $databaseUrl = "",
            $databaseName = "";
    
    public function __construct( ){
        parent::__construct( "mysql:host=".$this->databaseUrl.";dbname=".$this->databaseName, $this->username, $this->passwd);
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    /**
     * @param string $query This must be a valid SQL statement template for the target database server. 
     * @param array $parameters
     * @return bool if the execution was succesfull
     */
    private function executeTheQuery( string $query, array $parameters = []){
        $this->stmt=parent::prepare( $query);
        foreach ($parameters as $name => $value){
            $this->stmt->bindValue( $name, $value[0], $value[1]);
        }
        return $this->stmt->execute();
    }
    
    /**
     * Returns an array containing all of the result set rows
     * @return array SQLConnection::getTheResults returns an array containing all of the remaining rows in the result set. The array represents each row as either an array of column values or an object with properties corresponding to each column name. An empty array is returned if there are zero results to fetch, or false on failure.<br><br>Using this method to fetch large result sets will result in a heavy demand on system and possibly network resources. Rather than retrieving all of the data and manipulating it in PHP, consider using the database server to manipulate the result sets. For example, use the WHERE and ORDER BY clauses in SQL to restrict results before retrieving and processing them with PHP.
     */
    private function getTheResults( ){
        return $this->stmt == null ? array() : $this->stmt->fetchall();
    }
    
    /**
     * @var SQLConnection $connection
     */
    private static $connection = null;
    
    /**
     * @return SQLConnection
     */
    private static function getConnection(){
        if (SQLConnection::$connection == null){
            SQLConnection::$connection = new SQLConnection();
        }
        return SQLConnection::$connection;
    }
    
    /**
     * Prepares a statement for execution<br>
     * Binds the values to the parameters<br>
     * And executes the statement
     * @param string $query This must be a valid SQL statement template for the target database server. 
     * @param array $parameters the parameters
     * @return bool true on success or false on failure 
     */
    public static function executeQuery( string $query, array $parameters = []){
        return SQLConnection::getConnection()->executeTheQuery( $query, $parameters);
    }
    
    /**
     * Returns an array containing all of the result set rows
     * @return array SQLConnection::getResults returns an array containing all of the remaining rows in the result set. The array represents each row as either an array of column values or an object with properties corresponding to each column name. An empty array is returned if there are zero results to fetch, or false on failure.<br><br>Using this method to fetch large result sets will result in a heavy demand on system and possibly network resources. Rather than retrieving all of the data and manipulating it in PHP, consider using the database server to manipulate the result sets. For example, use the WHERE and ORDER BY clauses in SQL to restrict results before retrieving and processing them with PHP.
     */
    public static function getResults( ){
        return SQLConnection::getConnection()->getTheResults();
    }
    
}