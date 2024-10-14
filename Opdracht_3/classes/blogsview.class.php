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
  
            if (!empty($blog['link'])) {
                echo '<p><a href="' . htmlspecialchars($blog['link']) . '" target="_blank" class="btn btn-primary">Lees meer</a></p>';
            }
    
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
            
            if (!empty($blog['link'])) {
                echo '<p><a href="' . htmlspecialchars($blog['link']) . '" target="_blank" class="btn btn-primary">Lees meer</a></p>';
            }
    
            echo '</div>';
            echo '</div>';
            echo '</div>'; 
        } else {
            echo "Blog niet gevonden.";
        }
    }

    
    public function showBlogForm() {
        echo '<form method="post" action="blogscontr.php" class="mt-4">';
        echo '<div class="mb-3">'; 
        echo '<label for="title" class="form-label">Titel:</label>';
        echo '<input type="text" class="form-control" name="title" id="title" required>'; 
        echo '</div>';
        
        echo '<div class="mb-3">'; 
        echo '<label for="content" class="form-label">Inhoud:</label>'; 
        echo '<textarea class="form-control" name="content" id="content" required></textarea>'; 
        echo '</div>';
        echo '<div class="mb-3">'; 
        echo '<label for="link" class="form-label">Link (optioneel):</label>'; 
        echo '<input type="url" class="form-control" name="link" id="link">'; 
        echo '</div>';
        
        echo '<button type="submit" class="btn btn-primary">Maak blog aan</button>'; 
        echo '</form>';
    }
}