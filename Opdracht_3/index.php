<?php
session_start();
include 'includes/class-autoload.inc.php';

$controller = new BlogsContr();
$view = new BlogsView($controller);

if (isset($_SESSION['userid'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_blog'])) {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $link = $_POST['link'] ?? ''; // Link veld toegevoegd
        $userId = $_SESSION['userid'];

        $controller->createBlog($title, $content, $userId, $link);

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShareBoard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .card {
            border-radius: 15px;
            margin-bottom: 20px; 
        }
        .card-header {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Welkom bij ShareBoard!</h1>

    <?php if (isset($_SESSION['userid'])): ?>
        <h2 class="text-center">Welkom, <?= htmlspecialchars($_SESSION['email']) ?>!</h2>
        <p class="text-center">
            <a href="profile.php" class="btn btn-info">Bekijk mijn profiel</a>
        </p>

        <button class="btn btn-primary mb-3" id="toggleBlogForm">Maak een nieuwe blog aan</button>
        <div id="blogForm" style="display: none;">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="title">Titel:</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="content">Inhoud:</label>
                    <textarea name="content" id="content" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="url" name="link" id="link" class="form-control">
                </div>
                <button type="submit" name="create_blog" class="btn btn-success">Blog aanmaken</button>
                <button type="button" class="btn btn-danger" id="cancelBlogForm">Annuleren</button>
            </form>
        </div>

        <?php
        $blogs = array_reverse($controller->showBlogs());
        foreach ($blogs as $blog): ?>
            <div class="card">
                <div class="card-header">
                    <?= htmlspecialchars($blog['voornaam']) . ' ' . htmlspecialchars($blog['achternaam']) ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($blog['title']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($blog['inhoud']) ?></p>
                    <?php if (!empty($blog['link'])): ?>
                        <a href="<?= htmlspecialchars($blog['link']) ?>" target="_blank" class="btn btn-info">Lees meer</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <form method="post" action="logout.php">
            <button type="submit" class="btn btn-secondary">Uitloggen</button>
        </form>

    <?php else: ?>
        <h2 class="text-center">Registreren</h2>

        <form method="post" action="register.php">
            <div class="form-group">
                <label for="voornaam">Voornaam:</label>
                <input type="text" name="voornaam" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="achternaam">Achternaam:</label>
                <input type="text" name="achternaam" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gebdat">Geboortedatum:</label>
                <input type="date" name="gebdat" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="wachtwoord">Wachtwoord:</label>
                <input type="password" name="wachtwoord" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registreren</button>
        </form>

        <p class="text-center">Al een account? <a href="login.php">Inloggen</a></p>
    <?php endif; ?>
</div>

<script>
    $(document).ready(function() {
        $('#toggleBlogForm').click(function() {
            $('#blogForm').toggle();
            $(this).toggle();
        });

        $('#cancelBlogForm').click(function() {
            $('#blogForm').hide();
            $('#toggleBlogForm').show();
        });
    });
</script>
</body>
</html>