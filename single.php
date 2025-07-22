<?php
$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $post ? htmlspecialchars($post['title']) : 'Post Not Found' ?></title>
    <style>
    body {
        background-color: #0f0f1b;
        color: #fff;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 60px auto;
        padding: 20px;
    }

    h1 {
        color: #f65a5a;
        font-size: 36px;
        margin-bottom: 10px;
    }

    .meta {
        font-size: 14px;
        color: #aaa;
        margin-bottom: 20px;
    }

    .content {
        color: #ddd;
        line-height: 1.7;
        white-space: pre-line;
    }

    a.back {
        display: inline-block;
        margin-top: 30px;
        text-decoration: none;
        color: #ffd700;
        background: #1f1f2f;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background 0.3s ease;
    }

    a.back:hover {
        background-color: #2b2b3c;
    }

    .not-found {
        text-align: center;
        margin-top: 100px;
        color: #888;
    }
    </style>
</head>

<body>

    <div class="container">
        <?php if ($post): ?>
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <div class="meta">📂 <?= htmlspecialchars($post['category']) ?> | 🕒
            <?= date("d M Y", strtotime($post['created_at'])) ?></div>
        <div class="content"><?= nl2br(htmlspecialchars($post['content'])) ?></div>

        <a class="back" href="blog.php">← Back to Blog</a>
        <?php else: ?>
        <div class="not-found">
            <h2>😕 Blog post not found</h2>
            <a class="back" href="blog.php">← Back to Blog</a>
        </div>
        <?php endif; ?>
    </div>

</body>

</html>