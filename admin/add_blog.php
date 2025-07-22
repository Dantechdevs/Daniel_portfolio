<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("INSERT INTO blogs (title, category, content, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$title, $category, $content]);

    header("Location: blogs.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Blog Post</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #0f0f1b;
        color: #fff;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 700px;
        margin: 40px auto;
        padding: 20px;
    }

    h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #f65a5a;
    }

    label {
        display: block;
        margin: 15px 0 5px;
        font-weight: bold;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        background: #2a2a40;
        color: #fff;
        border: 1px solid #444;
        border-radius: 8px;
    }

    textarea {
        min-height: 120px;
    }

    .btn {
        display: inline-block;
        margin-top: 20px;
        background-color: #f65a5a;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #e14a4a;
    }

    a.back {
        color: #ffd700;
        text-decoration: underline;
        display: inline-block;
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <div class="container">
        <h2>➕ Add New Blog Post</h2>
        <form method="POST" action="">
            <label>Title <span style="color: #f65a5a;">*</span></label>
            <input type="text" name="title" required>

            <label>Category <span style="color: #f65a5a;">*</span></label>
            <input type="text" name="category" required>

            <label>Content <span style="color: #f65a5a;">*</span></label>
            <textarea name="content" required></textarea>

            <button type="submit" class="btn">Save Blog Post</button>
        </form>

        <a href="blogs.php" class="back">← Back to Blog List</a>
    </div>

</body>

</html>