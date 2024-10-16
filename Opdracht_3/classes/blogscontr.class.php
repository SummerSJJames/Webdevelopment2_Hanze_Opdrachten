<?php
class BlogsContr{
    private $blogModel;

    public function __construct() {
        $this->blogModel = new Blogs();
    }

    public function deleteBlog($blogId) {
        $this->blogModel->deleteBlog($blogId);
    }

    public function updateBlog($blogId, $title, $content, $link) {
        if (empty($title) || empty($content)) {
            echo "Title and content cannot be empty.";
            return;
        }
    
        $this->blogModel->updateBlog($blogId, $title, $content, $link);
    }

    public function getBlogById($blogId) {
        return $this->blogModel->getBlogById($blogId);
    }

    public function getBlogsByUserId($userId) {
        return $this->blogModel->getBlogsByUserId($userId);
    }

    public function createBlog($title, $content, $userId, $link = '') {
        if (empty($title) || empty($content)) {
            echo "Title and content cannot be empty.";
            return;
        }
    
        $blog = new Blog($title, $content, $userId, $link);
    
        $this->blogModel->addBlog($blog);
    
        echo "Blog created successfully!";
    }

    public function showBlogs() {
        return $this->blogModel->getBlogs();
    }
}