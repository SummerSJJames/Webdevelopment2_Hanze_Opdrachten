<?php
session_start(); 
include 'includes/class-autoload.inc.php';

$controller = new BlogsContr();
$view = new BlogsView($controller);

if (isset($_SESSION['userid'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_blog'])) {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $userId = $_SESSION['userid'];

        $controller->createBlog($title, $content, $userId);

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

    <?php
    if (isset($_SESSION['userid'])) {
        echo "<h2 class='text-center'>Welkom, " . htmlspecialchars($_SESSION['email']) . "!</h2>";
        echo "<p class='text-center'><a href='profile.php' class='btn btn-info'>Bekijk mijn profiel</a></p>";
    ?>
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
                <button type="submit" name="create_blog" class="btn btn-success">Blog aanmaken</button>
                <button type="button" class="btn btn-danger" id="cancelBlogForm">Annuleren</button>
            </form>
        </div>

        <?php
        $blogs = $controller->showBlogs();
        $blogs = array_reverse($blogs);
        foreach ($blogs as $blog) {
            echo "<div class='card'>";
            echo "<div class='card-header'>" . htmlspecialchars($blog['voornaam']) . " " . htmlspecialchars($blog['achternaam']) . "</div>"; 
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($blog['title']) . "</h5>"; 
            echo "<p class='card-text'>" . htmlspecialchars($blog['inhoud']) . "</p>"; 
            echo "</div>";
            echo "</div>"; 
        }

        echo '<form method="post" action="logout.php">';
        echo '<button type="submit" class="btn btn-secondary">Uitloggen</button>';
        echo '</form>';
    } else {
        echo "<h2 class='text-center'>Registreren</h2>";

    echo '<form method="post" action="register.php">';
    echo 'Voornaam: <input type="text" name="voornaam" class="form-control" required><br>';
    echo 'Achternaam: <input type="text" name="achternaam" class="form-control" required><br>';
    echo 'Geboortedatum: <input type="date" name="gebdat" class="form-control" required><br>';
    echo 'E-mail: <input type="email" name="email" class="form-control" required><br>';
    echo 'Wachtwoord: <input type="password" name="wachtwoord" class="form-control" required><br>';
    echo '<button type="submit" class="btn btn-primary">Registreren</button>';
    echo '</form>';

    echo '<p class="text-center">Al een account? <a href="login.php">Inloggen</a></p>';
    }
    ?>
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