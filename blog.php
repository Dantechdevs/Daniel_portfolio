<?php
$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

// Fetch categories for filter
$categories = $pdo->query("SELECT DISTINCT category FROM blogs ORDER BY category ASC")->fetchAll(PDO::FETCH_ASSOC);

// Handle search/filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filterCategory = isset($_GET['category']) ? trim($_GET['category']) : '';

$query = "SELECT * FROM blogs WHERE 1";
$params = [];

if ($search) {
    $query .= " AND (title LIKE ? OR content LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($filterCategory) {
    $query .= " AND category = ?";
    $params[] = $filterCategory;
}
$query .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mark page for nav highlight
$current_page = 'blog.php';
?>
<?php include('includes/header.php'); ?>

<style>
body {
    background: #0f0f1b;
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
}

.container {
    max-width: 1100px;
    margin: 40px auto;
    padding: 20px;
}

h1 {
    font-size: 32px;
    color: #f65a5a;
    margin-bottom: 20px;
}

.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.filters input[type="text"],
.filters select {
    padding: 10px;
    border-radius: 6px;
    border: none;
    background: #1f1f2f;
    color: #fff;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}

.blog-card {
    background: #1f1f2f;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
}

.blog-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.blog-card-content {
    padding: 15px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.blog-card-content h2 {
    font-size: 20px;
    margin: 0 0 10px;
    color: #ffd700;
}

.meta {
    font-size: 14px;
    color: #aaa;
    margin-bottom: 10px;
}

.excerpt {
    flex: 1;
    color: #ccc;
    margin-bottom: 15px;
}

.blog-card-content a {
    align-self: flex-start;
    background: #f65a5a;
    color: #fff;
    padding: 8px 15px;
    border-radius: 6px;
    text-decoration: none;
}

.blog-card-content a:hover {
    background: #e14a4a;
}
</style>

<div class="container">
    <h1>Latest Blogs</h1>

    <form method="GET" class="filters">
        <input type="text" name="search" placeholder="Search blogs..." value="<?= htmlspecialchars($search) ?>">
        <select name="category">
            <option value="">All Categories</option>
            <?php foreach ($categories as $cat): ?>
            <option value="<?= htmlspecialchars($cat['category']) ?>"
                <?= $filterCategory == $cat['category'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['category']) ?>
            </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <div class="blog-grid">
        <?php if ($blogs): ?>
        <?php foreach ($blogs as $blog): ?>
        <div class="blog-card">
            <?php if (!empty($blog['image'])): ?>
            <img src="uploads/blogs/<?= htmlspecialchars($blog['image']) ?>"
                alt="<?= htmlspecialchars($blog['title']) ?>">
            <?php else: ?>
            <img src="uploads/blogs/no-image.png" alt="No Image">
            <?php endif; ?>
            <div class="blog-card-content">
                <h2><?= htmlspecialchars($blog['title']) ?></h2>
                <div class="meta">
                    📂 <?= htmlspecialchars($blog['category']) ?> | 🕒
                    <?= date("d M Y", strtotime($blog['created_at'])) ?>
                </div>
                <div class="excerpt">
                    <?= htmlspecialchars(substr($blog['content'], 0, 100)) ?>...
                </div>
                <a href="single.php?id=<?= $blog['id'] ?>">Read More</a>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p style="text-align:center;color:#aaa;">No blogs found</p>
        <?php endif; ?>
    </div>
</div>

<?php include('includes/footer.php'); ?>