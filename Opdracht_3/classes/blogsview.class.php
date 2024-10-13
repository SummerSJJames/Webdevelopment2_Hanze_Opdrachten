<?php
class BlogsView{
    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function showAllBlogs() {
        $blogs = $this->controller->showBlogs();
        echo '<div class="container mt-4">';
        foreach ($blogs as $blog) {
            echo '<div class="card mb-4" style="border-radius: 15px;">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($blog['voornaam']) . ' ' . htmlspecialchars($blog['achternaam']) . '</h5>';
            echo '<h2 class="card-subtitle mb-2 text-muted">' . htmlspecialchars($blog['title']) . '</h2>';
            echo '<p class="card-text">' . htmlspecialchars($blog['inhoud']) . '</p>'; 
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }

    public function showBlog($id) {
        $blog = $this->controller->getBlogById($id);
        if ($blog) {
            echo '<div class="container mt-4">';
            echo '<div class="card mb-4" style="border-radius: 15px;">'; 
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($blog['voornaam']) . ' ' . htmlspecialchars($blog['achternaam']) . '</h5>';
            echo '<h2 class="card-subtitle mb-2 text-muted">' . htmlspecialchars($blog['title']) . '</h2>'; 
            echo '<p class="card-text">' . htmlspecialchars($blog['inhoud']) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>'; 
        } else {
            echo "Blog not found.";
        }
    }

    
    public function showBlogForm() {
        echo '<form method="post" action="blogscontr.php" class="mt-4">';
        echo '<div class="mb-3">'; 
        echo '<label for="title" class="form-label">Title:</label>';
        echo '<input type="text" class="form-control" name="title" id="title" required>'; 
        echo '</div>';
        
        echo '<div class="mb-3">'; 
        echo '<label for="content" class="form-label">Content:</label>'; 
        echo '<textarea class="form-control" name="content" id="content" required></textarea>'; 
        echo '</div>';
        
        echo '<button type="submit" class="btn btn-primary">Create Blog</button>'; 
        echo '</form>';
    }
}