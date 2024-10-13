<?php
session_start(); 
include 'includes/class-autoload.inc.php';

$controller = new BlogsContr();
$view = new BlogsView($controller);

if (!isset($_SESSION['userid'])) {
    header("Location: login.php"); 
    exit();
}

$userId = $_SESSION['userid'];
$blogs = $controller->getBlogsByUserId($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_blog'])) {
    $blogId = $_POST['blog_id'] ?? '';
    $controller->deleteBlog($blogId);
    header("Location: profile.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Profiel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            border-radius: 15px;
            margin-bottom: 20px; 
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Mijn Profiel</h1>
    <h2 class="text-center">Welkom, <?php echo htmlspecialchars($_SESSION['email']); ?>!</h2>

    <h3>Mijn Blogs</h3>
    <?php
    if ($blogs) {
        foreach ($blogs as $blog) {
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($blog['title']) . '</h5>';
            echo '<p class="card-text">' . htmlspecialchars($blog['inhoud']) . '</p>';
            
            echo '<form method="post" action="" style="display:inline;">'; // Inline display
            echo '<input type="hidden" name="blog_id" value="' . htmlspecialchars($blog['id']) . '">';
            echo '<button type="submit" name="delete_blog" class="btn btn-danger">Verwijderen</button>';
            echo '</form>';

            echo '<a href="editblog.php?id=' . htmlspecialchars($blog['id']) . '" class="btn btn-warning">Aanpassen</a>'; 
            echo '</div>';
            echo '</div>'; 
        }
    }
    ?>
    <a href="index.php" class="btn btn-secondary">Terug naar Homepage</a>
</div>

</body>
</html>
