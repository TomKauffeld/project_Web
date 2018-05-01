<?php

class Category implements JsonSerializable{

    /**
     * @var string $id the id of the category
     * @var string $name the name of the category
     */
    private $id, $name;

    /**
     * contructor
     * @param string $id the id of the category
     * @param string $name the name of the category
     */
    public function __construct( string $id, string $name){
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * gets the id
     * @return string the id of the category
     */
    public function getId( ){
        return $this->id;
    }

    /**
     * gets the name
     * @return string the name of the category
     */
    public function getName( ){
        return $this->name;
    }

    /**
     * {@inheritdoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName()
        ];
    }

}