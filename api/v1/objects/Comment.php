<?php

class Comment implements JsonSerializable{

    /**
     * @var string $id the id of the comment
     * @var string $post the id of the post it's attached to
     * @var int $time when it was posted (unix time stamp)
     * @var string $author the id of the author of this comment
     * @var string $body the body of the comment
     */
    protected $id, $post, $time, $author, $body;


    /**
     * @var string $id the id of the comment
     * @var string $post the id of the post it's attached to
     * @var string $author the id of the author of this comment
     * @var string $body the body of the comment
     * @var int $time when it was posted (unix time stamp)
     */
    public function __construct( string $id, string $post, string $author, string $body, int $time){
        $this->id = $id;
        $this->author = $author;
        $this->post = $post;
        $this->body = $body;
        $this->time = $time;
    }

    /**
     * @return string the id of the comment
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
     * @return string the id of the post this comment is attached to
     */
    public function getPost( ){
        return $this->post;
    }

    /**
     * @return string the body of the comment
     */
    public function getBody( ){
        return $this->body;
    }

    /**
     * @return int the time stamp of the comment (unix time)
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
            "post" => $this->getPost(),
            "author" => $this->getAuthor(),
            "body" => $this->getBody(),
            "time" => $this->getTime()
        ];
    }
}