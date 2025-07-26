<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

// Reset Default Admin
$message = "";
if (isset($_POST['reset_admin'])) {
    $defaultEmail = "admin@example.com";
    $defaultPass = password_hash("admin123", PASSWORD_DEFAULT);
    $defaultName = "Admin";

    // Check if exists
    $check = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $check->execute([$defaultEmail]);

    if ($check->rowCount() > 0) {
        $update = $pdo->prepare("UPDATE admins SET password = ?, name = ? WHERE email = ?");
        $update->execute([$defaultPass, $defaultName, $defaultEmail]);
        $message = "Default admin password reset to admin123.";
    } else {
        $insert = $pdo->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
        $insert->execute([$defaultName, $defaultEmail, $defaultPass]);
        $message = "Default admin created with email admin@example.com and password admin123.";
    }
}

// Add admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_admin'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);
    header("Location: manage_admins.php");
    exit;
}

// Delete admin
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM admins WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: manage_admins.php");
    exit;
}

// Fetch admins
$admins = $pdo->query("SELECT * FROM admins ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Manage Admins</title>
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

    .message {
        background: #28a745;
        color: #fff;
        padding: 10px;
        width: 80%;
        margin: 10px auto;
        text-align: center;
        border-radius: 5px;
    }

    table {
        width: 80%;
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

    .btn-delete {
        background: #f65a5a;
        color: #fff;
    }

    .btn-add {
        background: #28a745;
        color: #fff;
        margin: 20px auto;
        display: block;
    }

    .btn-reset {
        background: #007bff;
        color: #fff;
        margin: 20px auto;
        display: block;
    }

    form {
        text-align: center;
        margin-top: 30px;
    }

    input {
        padding: 10px;
        margin: 5px;
        border: none;
        border-radius: 6px;
    }
    </style>
</head>

<body>
    <h1>Manage Admins</h1>

    <!-- Success Message -->
    <?php if (!empty($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Reset Default Admin Button -->
    <form method="POST">
        <button type="submit" name="reset_admin" class="btn btn-reset"
            onclick="return confirm('Reset default admin account?')">
            Reset Default Admin
        </button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach($admins as $admin): ?>
        <tr>
            <td><?= $admin['id'] ?></td>
            <td><?= htmlspecialchars($admin['name']) ?></td>
            <td><?= htmlspecialchars($admin['email']) ?></td>
            <td>
                <a href="?delete=<?= $admin['id'] ?>" class="btn btn-delete"
                    onclick="return confirm('Delete this admin?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2 style="text-align:center; margin-top:30px;">Add New Admin</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="add_admin" class="btn btn-add">Add Admin</button>
    </form>
</body>

</html>