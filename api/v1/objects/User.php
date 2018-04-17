<?php

class User implements JsonSerializable{

    /**
     * @var string $id the id of the user
     * @var string $name the name of the user
     * @var int $adminLvL the level of permission : 0 user, 1 admin, 2 super-admin
     */
    private $id, $username, $adminLvL;

    /**
     * @param string $id the id of the user
     * @param string $name the name of the user
     * @param int $adminLvL the level of permission : 0 user, 1 admin, 2 super-admin
     */
    public function __construct( string $id, string $username, int $adminLvL){
        $this->id = $id;
        $this->username = $username;
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
    public function getUsername( ){
        return $this->username;
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
            "username" => $this->getUsername(),
            "adminLvL" => $this->getAdminLvL()
        ];
    }

}