<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");
$blogs = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Manage Blogs</title>
    <style>
        body {
            background: #0f0f1b;
            color: #fff;
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #f65a5a;
            text-align: center;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #1f1f2f;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #333;
        }

        th {
            background: #333;
        }

        tr:hover {
            background: #2c2c40;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-add {
            background: #28a745;
            color: #fff;
            margin: 20px auto;
            display: block;
            text-align: center;
            width: 200px;
        }

        .btn-edit {
            background: #007bff;
            color: #fff;
        }

        .btn-delete {
            background: #f65a5a;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Manage Blogs</h1>
    <a href="add_blog.php" class="btn btn-add">+ Add New Blog</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($blogs as $blog): ?>
            <tr>
                <td><?= $blog['id'] ?></td>
                <td><?= htmlspecialchars($blog['title']) ?></td>
                <td><?= htmlspecialchars($blog['category']) ?></td>
                <td><?= date("d M Y", strtotime($blog['created_at'])) ?></td>
                <td>
                    <a href="edit_blog.php?id=<?= $blog['id'] ?>" class="btn btn-edit">Edit</a>
                    <a href="delete_blog.php?id=<?= $blog['id'] ?>" class="btn btn-delete"
                        onclick="return confirm('Delete this blog?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>