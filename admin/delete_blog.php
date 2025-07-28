<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: manage_blogs.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

$id = $_GET['id'];

// Optional: confirm existence before deletion
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->execute([$id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    echo "Blog post not found.";
    exit;
}

// Delete blog post
$delete = $pdo->prepare("DELETE FROM blogs WHERE id = ?");
$delete->execute([$id]);

header("Location: manage_blogs.php");
exit;