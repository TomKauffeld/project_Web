<?php

class Post implements JsonSerializable{

    /**
     * @var string $id the id of the post
     * @var string $title the title of the post
     * @var int $time when it was posted (unix time stamp)
     * @var string $author the id of the author of this post
     * @var string $body the body of the post
     */
    protected $id, $title, $time, $author, $body;

    /**
     * @param string $id the id of the post
     * @param string $author the id of the author of this post
     * @param string $title the title of the post
     * @param string $body the body of the post
     * @param int $time when it was posted (unix time stamp)
     */
    public function __construct( string $id, string $author, string $title, string $body, int $time){
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->body = $body;
        $this->time = $time;
    }

    /**
     * @return string the id of the post
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string the id of the author
     */
    public function getAuthor( ){
        return $this->author;
    }

    /**
     * @return string the title of the post
     */
    public function getTitle( ){
        return $this->title;
    }

    /**
     * @return string the body of the post
     */
    public function getBody( ){
        return $this->body;
    }

    /**
     * @return int the time stamp of the post (unix time)
     */
    public function getTime(){
        return $this->time;
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
            "title" => $this->getTitle(),
            "body" => $this->getBody(),
            "time" => $this->getTime()
        ];
    }
}