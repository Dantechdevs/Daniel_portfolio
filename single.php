<?php
$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// For SEO
$pageTitle = $post ? $post['title'] : 'Blog Post Not Found';
$pageDesc = $post ? substr(strip_tags($post['content']), 0, 150) : 'View this blog post';
$pageImage = $post && !empty($post['image']) ? "uploads/blogs/" . $post['image'] : "uploads/blogs/no-image.png";

// Mark page
$current_page = 'blog.php';
?>
<?php include('includes/header.php'); ?>

<!-- SEO Meta -->
<meta name="description" content="<?= htmlspecialchars($pageDesc) ?>">
<meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>">
<meta property="og:image" content="<?= $pageImage ?>">
<meta property="og:url" content="<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">

<style>
body {
    background-color: #0f0f1b;
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
}

.container {
    max-width: 800px;
    margin: 40px auto;
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

.blog-image {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 20px;
}

.content {
    color: #ddd;
    line-height: 1.7;
    white-space: pre-line;
}

.share-buttons {
    display: flex;
    gap: 10px;
    margin-top: 30px;
    flex-wrap: wrap;
}

.share-buttons button {
    background: #1f1f2f;
    border: 1px solid #444;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    color: #ffd700;
    font-weight: bold;
    transition: 0.3s;
}

.share-buttons button:hover {
    background: #2a2a40;
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

<main>
    <div class="container">
        <?php if ($post): ?>
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <div class="meta">📂 <?= htmlspecialchars($post['category']) ?> | 🕒
            <?= date("d M Y", strtotime($post['created_at'])) ?></div>

        <?php if (!empty($post['image'])): ?>
        <img src="uploads/blogs/<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>"
            class="blog-image">
        <?php endif; ?>

        <div class="content"><?= nl2br(htmlspecialchars($post['content'])) ?></div>

        <!-- Share Buttons -->
        <div class="share-buttons">
            <button onclick="copyLink()">📋 Copy Link</button>
            <button onclick="shareFacebook()">Facebook</button>
            <button onclick="shareTwitter()">Twitter</button>
            <button onclick="shareLinkedIn()">LinkedIn</button>
            <button onclick="shareWhatsApp()">WhatsApp</button>
        </div>

        <a class="back" href="blog.php">← Back to Blog</a>
        <?php else: ?>
        <div class="not-found">
            <h2>😕 Blog post not found</h2>
            <a class="back" href="blog.php">← Back to Blog</a>
        </div>
        <?php endif; ?>
    </div>
</main>

<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        alert("Link copied to clipboard!");
    });
}

function shareFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, "_blank");
}

function shareTwitter() {
    window.open(
        `https://twitter.com/intent/tweet?url=${encodeURIComponent(window.location.href)}&text=Check out this blog!`,
        "_blank");
}

function shareLinkedIn() {
    window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(window.location.href)}`,
        "_blank");
}

function shareWhatsApp() {
    window.open(
        `https://api.whatsapp.com/send?text=${encodeURIComponent("Check out this blog: " + window.location.href)}`,
        "_blank");
}
</script>

<?php include('includes/footer.php'); ?>