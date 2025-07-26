<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// DB connection
$pdo = new PDO("mysql:host=localhost;dbname=daniel_portfolio;charset=utf8mb4", "root", "");

// Fetch current admin
$stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
$stmt->execute([$_SESSION['admin_email']]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle profile update (name/email)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE admins SET name=?, email=? WHERE id=?");
    $stmt->execute([$name, $email, $admin['id']]);

    $_SESSION['admin_email'] = $email;
    header("Location: profile.php?success=profile");
    exit;
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    if (password_verify($currentPassword, $admin['password'])) {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE admins SET password=? WHERE id=?");
        $stmt->execute([$hashed, $admin['id']]);
        header("Location: profile.php?success=password");
        exit;
    } else {
        $error = "Current password is incorrect!";
    }
}

// Handle profile picture upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_image'])) {
    if (!empty($_FILES['profile_image']['name'])) {
        $targetDir = __DIR__ . '/../assets/img/';
        $fileName = 'admin_' . $admin['id'] . '_' . basename($_FILES['profile_image']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
            $stmt = $pdo->prepare("UPDATE admins SET profile_image=? WHERE id=?");
            $stmt->execute([$fileName, $admin['id']]);
            header("Location: profile.php?success=image");
            exit;
        } else {
            $error = "Failed to upload image.";
        }
    }
}

// Determine image to show
$profileImage = !empty($admin['profile_image']) ? $admin['profile_image'] : 'default.png';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Profile</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #0f0f1b;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #1f1f2f;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        h1 {
            color: #f65a5a;
        }

        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background: #f65a5a;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background: #e54e4e;
        }

        .success {
            color: #28a745;
        }

        .error {
            color: #ff4d4d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>My Profile</h1>

        <?php if (isset($_GET['success'])): ?>
            <p class="success">
                <?php
                if ($_GET['success'] === 'profile') echo "Profile updated successfully!";
                if ($_GET['success'] === 'password') echo "Password changed successfully!";
                if ($_GET['success'] === 'image') echo "Profile image updated!";
                ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <img src="../assets/img/<?= htmlspecialchars($profileImage) ?>" alt="Profile Picture">

        <!-- Upload Profile Picture -->
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="profile_image" required>
            <button type="submit" name="upload_image">Upload Picture</button>
        </form>

        <!-- Update Name/Email -->
        <form method="POST">
            <input type="text" name="name" value="<?= htmlspecialchars($admin['name']) ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required>
            <button type="submit" name="update_profile">Update Profile</button>
        </form>

        <!-- Change Password -->
        <form method="POST">
            <input type="password" name="current_password" placeholder="Current Password" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <button type="submit" name="change_password">Change Password</button>
        </form>
    </div>
</body>

</html>