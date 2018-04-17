<?php

class Category implements JsonSerializable{

    /**
     * @var string $id the id of the category
     * @var string $name the name of the category
     * @var string $description the description of the category
     */
    private $id, $name, $description;

    /**
     * contructor
     * @param string $id the id of the category
     * @param string $name the name of the category
     * @param string $description the description of the category
     */
    public function __construct( string $id, string $name, string $description){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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
     * gets the description
     * @return string the description of the category
     */
    public function getDescription( ){
        return $this->description;
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
            "description" => $this->getDescription()
        ];
    }

}