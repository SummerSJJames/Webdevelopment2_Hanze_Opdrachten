<?php
session_start(); 
include 'includes/class-autoload.inc.php';

$controller = new BlogsContr();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php"); // Redirect naar inlogpagina als niet ingelogd
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_blog'])) {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $blogId = $_POST['blog_id'] ?? '';

    $controller->updateBlog($blogId, $title, $content); // Zorg ervoor dat je deze functie toevoegt in de controller
    header("Location: profile.php"); // Redirect naar het profiel na update
    exit();
}

$blogId = $_GET['id'] ?? null;
$blog = $controller->getBlogById($blogId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Aanpassen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Blog Aanpassen</h1>
    
    <?php if ($blog): ?>
        <form method="post" action="">
            <input type="hidden" name="blog_id" value="<?php echo htmlspecialchars($blog['id']); ?>">
            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="content">Inhoud:</label>
                <textarea name="content" id="content" class="form-control" required><?php echo htmlspecialchars($blog['inhoud']); ?></textarea>
            </div>
            <button type="submit" name="update_blog" class="btn btn-success">Bijwerken</button>
        </form>
    <?php else: ?>
        <p>Blog niet gevonden.</p>
    <?php endif; ?>
</div>

</body>
</html>