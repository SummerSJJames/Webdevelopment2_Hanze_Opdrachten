<?php
class Blog extends Dbh {
    private $title;
    private $content;
    private $userId;

    public function __construct($title, $content, $userId) {
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
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
}