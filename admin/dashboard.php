<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include('includes/header.php');
?>

<style>
.dashboard {
    text-align: center;
    padding: 60px 20px;
}

.dashboard h1 {
    font-size: 36px;
    color: #f65a5a;
    margin-bottom: 10px;
}

.dashboard p {
    color: #aaa;
    margin-bottom: 40px;
}

.admin-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    max-width: 1000px;
    margin: auto;
}

.card {
    background-color: #1f1f2f;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.card h2 {
    color: #ffd700;
    margin-bottom: 10px;
}

.card p {
    color: #ccc;
    margin-bottom: 20px;
}

.card a {
    background-color: #f65a5a;
    padding: 10px 20px;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.card a:hover {
    background-color: #e54e4e;
}
</style>

<div class="dashboard">
    <h1>Welcome Admin 👋</h1>
    <p>Manage your content and stay in control of your portfolio website.</p>

    <div class="admin-cards">
        <div class="card">
            <h2>📝 Blog Posts</h2>
            <p>Manage, edit and create new blog posts for your website visitors.</p>
            <a href="blogs.php">Go to Blogs</a>
        </div>
        <div class="card">
            <h2>🚀 Projects</h2>
            <p>View and manage your portfolio projects, including GitHub links.</p>
            <a href="projects.php">Go to Projects</a>
        </div>
        <div class="card">
            <h2>🔒 Logout</h2>
            <p>End your admin session securely and return to the homepage.</p>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>