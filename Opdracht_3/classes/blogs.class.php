<?php
class Blogs extends Dbh {
    public function addBlog(Blog $blog) {
        $sql = "INSERT INTO blogs (title, inhoud, link, userid) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$blog->getTitle(), $blog->getContent(), $blog->getLink(), $blog->getUserId()]);
    }

    public function getBlogs() {
        $sql = "SELECT * FROM blogs";
        $stmt = $this->connect()->query($sql);
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $usersModel = new Users();
    
        foreach ($blogs as &$blog) {
            $user = $usersModel->getUserById($blog['userid']);
            if ($user) {
                $blog['voornaam'] = $user['voornaam'];
                $blog['achternaam'] = $user['achternaam'];
            } else {
                $blog['voornaam'] = 'Onbekend';
                $blog['achternaam'] = '';
            }
        }
    
        return $blogs;
    }

    public function getBlogById($blogId) {
        $sql = "SELECT * FROM blogs WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$blogId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function getBlogsByUserId($userId) {
        $sql = "SELECT * FROM blogs WHERE userid = ?"; 
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    public function deleteBlog($blogId) {
        $sql = "DELETE FROM blogs WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$blogId]);
    }

    public function updateBlog($blogId, $title, $content, $link) {
        $sql = "UPDATE blogs SET title = ?, inhoud = ?, link = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$title, $content, $link, $blogId]);
    }
}