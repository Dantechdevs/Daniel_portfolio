<?php
session_start();
// Uncomment to restrict access
// if (!isset($_SESSION['admin'])) {
//     header('Location: ../login.php');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Project - Admin</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #0f0f1b;
        color: white;
    }

    .upload-container {
        max-width: 600px;
        margin: 60px auto;
        padding: 30px;
        background: #1f1f2f;
        border-radius: 15px;
    }

    .upload-container h3 {
        color: #f65a5a;
    }

    .form-control {
        background-color: #2a2a40;
        color: white;
        border: none;
    }

    .btn-custom {
        background-color: #f65a5a;
        color: white;
        font-weight: bold;
        border-radius: 8px;
    }
    </style>
</head>

<body>

    <div class="upload-container">
        <h3 class="text-center mb-4">📤 Upload a Project</h3>

        <?php if (isset($_GET['success']) && $_GET['success'] === "1"): ?>
        <div class="alert alert-success text-center">✅ Project uploaded successfully!</div>
        <?php endif; ?>

        <form action="../php/save_project.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Project Title" required class="form-control mb-3 rounded-3">
            <textarea name="description" placeholder="Project Description" required rows="4"
                class="form-control mb-3 rounded-3"></textarea>
            <input type="url" name="github_url" placeholder="GitHub URL (optional)" class="form-control mb-3 rounded-3">
            <input type="file" name="image" accept="image/*" class="form-control mb-3 rounded-3">
            <button type="submit" class="btn btn-custom w-100">Upload Project</button>
        </form>
    </div>

</body>

</html>