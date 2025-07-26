<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

// Fetch blogs
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f0f1b, #1e3c72);
    color: #fff;
}

.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(8px);
}

.topbar h2 {
    margin: 0;
}

.logout-btn {
    background: #f65a5a;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    color: white;
}

.container {
    max-width: 1100px;
    margin: 30px auto;
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: 12px;
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.add-btn {
    padding: 10px 15px;
    background: linear-gradient(90deg, #00c6ff, #0072ff);
    border-radius: 8px;
    text-decoration: none;
    color: #fff;
}

input[type="text"] {
    padding: 8px 12px;
    border-radius: 6px;
    border: none;
    width: 250px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 12px;
    text-align: left;
}

th {
    background: #2a5298;
}

tr:nth-child(even) {
    background: rgba(255, 255, 255, 0.05);
}

.actions a {
    margin-right: 10px;
    color: #00c6ff;
    text-decoration: none;
}

.actions a.delete {
    color: #f65a5a;
}

.blog-thumb {
    width: 60px;
    height: 40px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #333;
}
</style>

<div class="topbar">
    <h2>Manage Blogs</h2>
    <a class="logout-btn" href="logout.php">Logout</a>
</div>

<div class="container">
    <div class="header-actions">
        <a href="add_blog.php" class="add-btn">+ Add Blog</a>
        <input type="text" placeholder="Search blogs..." id="searchBox" onkeyup="searchBlogs()">
    </div>

    <table id="blogTable">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($blogs): ?>
            <?php foreach ($blogs as $blog): ?>
            <tr>
                <td>
                    <?php if (!empty($blog['image'])): ?>
                    <img src="../uploads/blogs/<?= htmlspecialchars($blog['image']) ?>" class="blog-thumb" alt="">
                    <?php else: ?>
                    <span style="color:#aaa;">No Image</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($blog['title']) ?></td>
                <td><?= htmlspecialchars($blog['category']) ?></td>
                <td><?= date("d M Y", strtotime($blog['created_at'])) ?></td>
                <td class="actions">
                    <a href="edit_blog.php?id=<?= $blog['id'] ?>">Edit</a>
                    <a href="delete_blog.php?id=<?= $blog['id'] ?>" class="delete"
                        onclick="return confirm('Delete this blog?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;color:#aaa;">No blogs found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function searchBlogs() {
    let input = document.getElementById('searchBox').value.toLowerCase();
    let rows = document.querySelectorAll('#blogTable tbody tr');
    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(input) ? '' : 'none';
    });
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>