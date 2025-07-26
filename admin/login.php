<?php
session_start();

// DB Connection
$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

// AUTO-CREATE DEFAULT ADMIN IF TABLE EMPTY
$check = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
if ($check == 0) {
    $defaultHash = password_hash('admin123', PASSWORD_DEFAULT);
    $pdo->prepare("INSERT INTO admins (name, email, password) VALUES (?, ?, ?)")
        ->execute(['Admin', 'admin@example.com', $defaultHash]);
}

// Handle login form
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Fetch admin from DB
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            width: 350px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            padding: 30px 25px;
            text-align: center;
            color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .login-container h2 {
            margin-bottom: 25px;
            font-weight: 600;
        }

        .input-field {
            position: relative;
            margin-bottom: 20px;
        }

        .input-field input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border: none;
            border-radius: 8px;
            background: #f1f1f1;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        .input-field i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
            cursor: pointer;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            color: white;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }

        .error {
            color: #ff4d4d;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="input-field">
                <input type="email" name="email" placeholder="Email" required>
                <i class="fa fa-envelope"></i>
            </div>
            <div class="input-field">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fa fa-eye" id="togglePassword"></i>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        togglePassword.addEventListener('click', () => {
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
            togglePassword.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>