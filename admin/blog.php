<?php include('../includes/header.php'); ?>

<style>
body {
    background-color: #0f0f1b;
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
    padding: 40px 20px;
}

.blog-container {
    max-width: 1200px;
    margin: auto;
}

.blog-title {
    text-align: center;
    font-size: 36px;
    color: #f65a5a;
    margin-bottom: 40px;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.blog-card {
    background: #1f1f2f;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.blog-card h3 {
    color: #f65a5a;
    margin-bottom: 10px;
}

.blog-card p {
    color: #ccc;
}

.blog-meta {
    font-size: 14px;
    color: #999;
    margin-bottom: 10px;
}

.read-more {
    margin-top: 15px;
    display: inline-block;
    padding: 10px 16px;
    background-color: #f65a5a;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.read-more:hover {
    background-color: #e54e4e;
}
</style>

<div class="blog-container">
    <h2 class="blog-title">📰 Latest Blog Posts</h2>

    <div class="blog-grid">
        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");
        $stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php if (count($blogs) > 0): ?>
        <?php foreach ($blogs as $post): ?>
        <div class="blog-card">
            <div>
                <h3><?= htmlspecialchars($post['title']) ?></h3>
                <div class="blog-meta">📂 <?= htmlspecialchars($post['category']) ?> | 🕒
                    <?= date("d M Y", strtotime($post['created_at'])) ?></div>
                <p><?= nl2br(substr(htmlspecialchars($post['content']), 0, 120)) ?>...</p>
            </div>
            <a class="read-more" href="../single.php?id=<?= $post['id'] ?>">Read More</a>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p style="text-align:center; color:#aaa;">No blog posts found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include('../includes/footer.php'); ?>