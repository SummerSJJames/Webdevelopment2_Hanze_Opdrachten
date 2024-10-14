<?php
class Blog extends Dbh {
    private $title;
    private $content;
    private $userId;
    private $link;

    public function __construct($title, $content, $userId, $link = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ') {
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
        $this->link = $link;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getLink() { 
        return $this->link;
    }
}