<?php

class Category implements JsonSerializable{

    private $id, $name, $description;

    public function __construct( string $id, string $name, string $description){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId( ){
        return $this->id;
    }

    public function getName( ){
        return $this->name;
    }

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