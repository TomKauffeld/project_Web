<?php

class Post implements JsonSerializable{

    /**
     * @var string $id the id of the post
     * @var string $title the title of the post
     * @var int $time when it was posted (unix time stamp)
     * @var string $author the id of the author of this post
     * @var string $body the body of the post
     * @var array $categories the categories of the post
     */
    protected $id, $title, $time, $author, $body, $categories, $image;

    /**
     * contructor
     * @param string $id the id of the post
     * @param string $author the id of the author of this post
     * @param string $title the title of the post
     * @param string $body the body of the post
     * @param int $time when it was posted (unix time stamp)
     */
    public function __construct( string $id, string $author, array $categories, string $title, string $body, int $time, string $image = null){
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->body = $body;
        $this->time = $time;
        $this->categories = $categories;
        $this->image = $image;
    }

    public function getImage( ){
        return $this->image;
    }

    /**
     * gets the id
     * @return string the id of the post
     */
    public function getId(){
        return $this->id;
    }

    /**
     * gets the author
     * @return string the id of the author
     */
    public function getAuthor( ){
        return $this->author;
    }

    /**
     * gets the title
     * @return string the title of the post
     */
    public function getTitle( ){
        return $this->title;
    }

    /**
     * gets the body of the post
     * @return string the body of the post
     */
    public function getBody( ){
        return $this->body;
    }

    /**
     * gets the time stamp
     * @return int the time stamp of the post (unix time)
     */
    public function getTime(){
        return $this->time;
    }

    /**
     * gets the categories from the post
     * @return array the ids of the categories
     */
    public function getCategories(){
        return $this->categories;
    }

    /**
     * adds a category to the post
     * @param string $category the id of the category to add
     */
    public function addCategory( string $category){
        $this->categories[] = $category;
    }

    /**
     * {@inheritdoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "author" => $this->getAuthor(),
            "nbCategories" => count( $this->getCategories()),
            "categories" => $this->getCategories(),
            "title" => $this->getTitle(),
            "body" => $this->getBody(),
            "time" => $this->getTime(),
            "image" => $this->getImage()
        ];
    }
}