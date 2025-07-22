<?php
session_start();

// Simple hardcoded credentials (you can connect to DB later)
$admin_email = "admin@example.com";
$admin_password = "admin123";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("Location: blogs.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <style>
    body {
        background-color: #0f0f1b;
        font-family: Arial, sans-serif;
        color: white;
        margin: 0;
        padding: 0;
    }

    .login-container {
        max-width: 400px;
        margin: 100px auto;
        background: #1f1f2f;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #f65a5a;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: none;
        border-radius: 8px;
        background: #2a2a40;
        color: white;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #f65a5a;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
    }

    .error {
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>🔐 Admin Login</h2>

        <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="email" name="email" placeholder="Admin Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>